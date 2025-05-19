<?php

namespace App\controllers;

use App\core\View;

class HomeController
{
    public function homeWithLayout(): string
    {
        $data = [
            'title' => 'Home Page',
            'message' => 'Home page content goes here.',
        ];

        // Render the view with layout
        return View::renderWithLayout('home', $data);
    }
}
