<?php

namespace App\routes;

use App\routes\Router;
use App\controllers\HomeController;
use App\controllers\UserController;
use App\core\View;

class Web
{
    private $router;
    private $homeController;
    private $userController;

    public function __construct()
    {
        $this->homeController = new HomeController();
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
        $this->router->get('/home', fn() => $this->homeController->homeWithLayout());
        // User routes
        $this->router->get('/users/{id}', fn($id) => $this->userController->show((int)$id));
        $this->router->get('/users', fn() => $this->userController->list());
        $this->router->post('/users', fn() => $this->userController->store());
        // Dispatch request
        $this->router->dispatch();
    }
}
