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
            throw new Exception("Không tìm thấy người dùng với id: $id");
        }
        return $user;
    }

    /**
     * Get all users
     * 
     * @param int $page
     * @param int $perPage
     * @return array|LengthAwarePaginator
     */
    public function getAllUsers($page, $perPage)
    {
        $user = $this->repo->findAll($page, $perPage);
        if (!$user) {
            throw new Exception("Hiện tại không có người dùng nào");
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
    public function createUser($name, $email, $password): User
    {
        $existingUser = $this->repo->findByEmail($email);
        if ($existingUser) {
            throw new Exception("Người dùng: $email đã tồn tại");
        }
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        return $this->repo->create(new User(null, $name, $email, null, $hashed));
    }
}
