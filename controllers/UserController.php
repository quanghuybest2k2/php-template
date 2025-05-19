<?php

namespace App\controllers;

use App\services\UserService;
use App\core\View;
use App\utils\Logger;
use Exception;

class UserController
{
    private $service;

    public function __construct()
    {
        $this->service =  new UserService();
    }

    /**
     * Show user by id
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        try {
            $user = $this->service->getUserById($id);
            return View::renderWithLayout('user/detail', ['user' => $user], 'layout');
        } catch (Exception $e) {
            throw new Exception("user show: " . $e->getMessage());
        }
    }

    /**
     * List all users
     *
     * @return void
     */
    public function list()
    {
        try {
            $users = $this->service->getAllUsers();
            return View::renderWithLayout('user/list', ['users' => $users], 'layout');
        } catch (Exception $e) {
            throw new Exception("user list: " . $e->getMessage());
        }
    }

    /**
     * Create a new user
     *
     * @return void
     */
    public function store(): void
    {
        $data = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'password' => $_POST['password'] ?? null,
        ];

        if (!isset($data['name'], $data['email'], $data['password'])) {
            echo "Invalid input";
            return;
        }

        try {
            $user = $this->service->createUser($data['name'], $data['email'], $data['password']);
        } catch (Exception $e) {
            throw new Exception("user create: " . $e->getMessage());
        }

        // ResponseHandler::responseSuccess($user, "User created successfully", 201);
    }
}
