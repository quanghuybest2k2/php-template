<?php

namespace App\services;

use App\models\User;
use App\repositories\UserRepository;
use Exception;

class UserService
{
    private $repo;

    public function __construct()
    {
        $this->repo =  new UserRepository();
    }

    /**
     * Get user by id
     *
     * @param int $id
     * @return User
     */
    public function getUserById($id): User
    {
        $user = $this->repo->findById($id);
        if (!$user) {
            throw new Exception("User not found");
        }
        return $user;
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        $user = $this->repo->findAll();
        if (!$user) {
            throw new Exception("No users found");
        }
        return $user;
    }

    /**
     * Create a new user
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function createUser($name, $email, $password)
    {
        $existingUser = $this->repo->findByEmail($email);
        if ($existingUser) {
            throw new Exception("User with email: $email already exists");
        }
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        return $this->repo->create(new User(null, $name, $email, $hashed));
    }
}
