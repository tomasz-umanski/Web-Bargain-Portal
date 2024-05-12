<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    private function createUserFromData(array $user): User {
        return new User(
            $user['id'],
            $user['user_name'],
            $user['email'],
            $user['password'],
            $user['role_name']
        );
    }

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.*, ur.name AS role_name
            FROM users u
            JOIN user_roles ur ON ur.id = u.role_id
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
            INSERT INTO users (user_name, email, password, role_id)
            SELECT ?, ?, ?, id
            FROM user_roles
            WHERE name = ?
            RETURNING id;
        ');
    
        $stmt->execute([
            $user->getUserName(),
            $user->getEmail(),
            $user->getPassword(),
            'client'
        ]);
    
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}