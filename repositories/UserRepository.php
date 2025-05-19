<?php

namespace App\repositories;

use App\models\User;
use App\config\Database;

class UserRepository
{
    public function findById($id): ?User
    {
        $stmt = Database::getPdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? new User($row['id'], $row['name'], $row['email']) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = Database::getPdo()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        return $row ? new User($row['id'], $row['name'], $row['email']) : null;
    }

    public function findAll(): array
    {
        $stmt = Database::getPdo()->prepare("SELECT * FROM users");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $users = [];
        foreach ($rows as $row) {
            $users[] = new User($row['id'], $row['name'], $row['email']);
        }

        return $users;
    }

    public function create(User $user): User
    {
        $stmt = Database::getPdo()->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$user->name, $user->email, $user->password]);
        $user->id = Database::getPdo()->lastInsertId();
        return $user;
    }
}
