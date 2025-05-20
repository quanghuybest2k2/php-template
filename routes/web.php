<?php

namespace App\routes;

use App\routes\Router;
use App\controllers\UserController;
use App\core\View;

class Web
{
    private $router;
    private $userController;

    public function __construct()
    {
        $this->userController = new UserController();
        $this->router = new Router();
    }

    /**
     * Handle the incoming request.
     *
     * @return void
     */
    public function handleRequest(): void
    {
        // Default route
        $this->router->get('/', fn() => View::render('welcome', ['greeting' => 'Welcome to your application!']));
        // User routes
        $this->router->get('/users/{id}', fn($id) => $this->userController->show((int)$id));
        $this->router->get('/users', fn() => $this->userController->list());
        $this->router->get('/create', fn() => $this->userController->create());
        $this->router->post('/store', fn() => $this->userController->store());
        // Dispatch request
        $this->router->dispatch();
    }
}
