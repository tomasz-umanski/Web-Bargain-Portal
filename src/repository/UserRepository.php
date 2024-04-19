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

}