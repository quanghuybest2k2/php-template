<?php

namespace App\controllers;

use Exception;
use Core\View;
use Core\Redirect;
use App\services\UserService;
use App\validators\UserValidator;

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
     * @return string
     */
    public function show($id): string
    {
        try {
            $user = $this->service->getUserById($id);
            return View::renderWithLayout('user/detail', ['title' => 'Xem chi tiết', 'user' => $user], 'layout');
        } catch (Exception $e) {
            throw new Exception("user show: " . $e->getMessage());
        }
    }

    /**
     * List all users
     *
     * @return string
     */
    public function list(): string
    {
        try {
            $users = $this->service->getAllUsers();
            return View::renderWithLayout('user/list', ['title' => 'Danh sách người dùng', 'users' => $users], 'layout');
        } catch (Exception $e) {
            throw new Exception("user list: " . $e->getMessage());
        }
    }

    /**
     * return create user view
     *
     * @return string
     */
    public function create(): string
    {
        try {
            return View::renderWithLayout('user/create', ['title' => 'Tạo người dùng'], 'layout');
        } catch (Exception $e) {
            throw new Exception("user create: " . $e->getMessage());
        }
    }

    /**
     * Create a new user
     *
     * @return string
     */
    public function store()
    {
        $data = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'password' => $_POST['password'] ?? null,
        ];

        // Validate data
        $errors = UserValidator::validate($data);
        if (!empty($errors)) {
            Redirect::with('/create', [
                'validation_errors' => $errors,
                'old' => $data // Keep old input data
            ]);
            return;
        }

        try {
            $user = $this->service->createUser($data['name'], $data['email'], $data['password']);
            if (!$user) {
                Redirect::with('/create', ['error' => 'Thêm người dùng thất bại']);
                return;
            }
            Redirect::with('/users', ['message' => 'Thêm người dùng thành công']);
        } catch (Exception $e) {
            Redirect::with('/create', ['error' => $e->getMessage()]);
        }
    }
}
