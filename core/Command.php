<?php

namespace App\core;

class Command
{
    protected array $colors;

    public function __construct(array $colors = [])
    {
        $this->colors = $colors;
    }

    /**
     * Create a new controller file.
     *
     * @param string|null $className
     * @return void
     */
    public function makeController(?string $className): void
    {
        if (!$className) {
            echo "{$this->colors['red']}❌ Missing controller name!{$this->colors['reset']}\n";
            echo "{$this->colors['blue']}📘 Usage example: php flow make:controller HomeController{$this->colors['reset']}\n";
            exit(1);
        }

        $directory = __DIR__ . '/../controllers';
        $filePath = "$directory/{$className}.php";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($filePath)) {
            echo "{$this->colors['yellow']}⚠️ Controller already exists: {$this->colors['reset']}$filePath\n";
            exit(1);
        }

        $template = <<<PHP
        <?php

        namespace App\controllers;

        class {$className}
        {
            public function index()
            {
                // TODO: Implement logic
            }
        }
        PHP;

        file_put_contents($filePath, $template);
        echo "{$this->colors['green']}✅ Controller created: {$this->colors['reset']}controllers/{$className}.php\n";
    }

    /**
     * Create a new model file.
     *
     * @param string|null $className The name of the model class.
     * @return void
     */
    public function makeModel(?string $className): void
    {
        if (!$className) {
            echo "{$this->colors['red']}❌ Missing model name!{$this->colors['reset']}\n";
            echo "{$this->colors['blue']}📘 Usage example: php flow make:model User{$this->colors['reset']}\n";
            exit(1);
        }

        $directory = __DIR__ . '/../models';
        $filePath = "$directory/{$className}.php";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($filePath)) {
            echo "{$this->colors['yellow']}⚠️ Model already exists: {$this->colors['reset']}$filePath\n";
            exit(1);
        }

        $template = <<<PHP
        <?php

        namespace App\models;

        class {$className}
        {
            // TODO: Define model properties and methods
        }
        PHP;

        file_put_contents($filePath, $template);
        echo "{$this->colors['green']}✅ Model created: {$this->colors['reset']}models/{$className}.php\n";
    }

    /**
     * Create a new service file.
     *
     * @param string|null $className The name of the service class.
     * @return void
     */
    public function makeService(?string $className): void
    {
        if (!$className) {
            echo "{$this->colors['red']}❌ Missing service name!{$this->colors['reset']}\n";
            echo "{$this->colors['blue']}📘 Usage example: php flow make:service User{$this->colors['reset']}\n";
            exit(1);
        }

        $directory = __DIR__ . '/../services';
        $filePath = "$directory/{$className}.php";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($filePath)) {
            echo "{$this->colors['yellow']}⚠️ Service already exists: {$this->colors['reset']}$filePath\n";
            exit(1);
        }

        $template = <<<PHP
        <?php

        namespace App\services;

        class {$className}
        {
            // TODO: Define service properties and methods
        }
        PHP;

        file_put_contents($filePath, $template);
        echo "{$this->colors['green']}✅ Service created: {$this->colors['reset']}services/{$className}.php\n";
    }

    /**
     * Create a new repository file.
     *
     * @param string|null $className The name of the repository class.
     * @return void
     */
    public function makeRepository(?string $className): void
    {
        if (!$className) {
            echo "{$this->colors['red']}❌ Missing repository name!{$this->colors['reset']}\n";
            echo "{$this->colors['blue']}📘 Usage example: php flow make:repository User{$this->colors['reset']}\n";
            exit(1);
        }

        $directory = __DIR__ . '/../repositories';
        $filePath = "$directory/{$className}.php";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($filePath)) {
            echo "{$this->colors['yellow']}⚠️ Repository already exists: {$this->colors['reset']}$filePath\n";
            exit(1);
        }

        $template = <<<PHP
        <?php

        namespace App\\repositories;

        class {$className}
        {
            // TODO: Define repository properties and methods
        }
        PHP;

        file_put_contents($filePath, $template);
        echo "{$this->colors['green']}✅ Repository created: {$this->colors['reset']}repositories/{$className}.php\n";
    }
}
