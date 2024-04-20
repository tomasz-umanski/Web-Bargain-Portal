<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    private function createUserFromData(array $user): User {
        return new User(
            $user['id'],
            $user['user_name'],
            $user['email'],
            $user['password']
        );
    }

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * 
            FROM users u 
            WHERE email = :email OR user_name = :email;
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return $this->createUserFromData($user);
    }

    public function userNameExists(string $userName): bool {
        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) 
            FROM users 
            WHERE LOWER(user_name) = LOWER(:userName);
        ');
        $stmt->execute([':userName' => $userName]);
    
        return (bool) $stmt->fetchColumn();
    }

    public function emailExists(string $email): bool {
        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) 
            FROM users 
            WHERE LOWER(email) = LOWER(:email);
        ');
        $stmt->execute([':email' => $email]);
    
        return (bool) $stmt->fetchColumn();
    }

    public function createUser(User $user): string {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (user_name, email, password)
            VALUES (?, ?, ?)
            RETURNING id;
        ');

        $stmt->execute([
            $user->getUserName(),
            $user->getEmail(),
            $user->getPassword()
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}