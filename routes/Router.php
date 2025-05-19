<?php

namespace App\routes;

class Router
{
    private array $routes = [];

    /**
     * GET method
     *
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    /**
     * POST method
     *
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    /**
     * PUT method
     *
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function put(string $path, callable $handler): void
    {
        $this->addRoute('PUT', $path, $handler);
    }

    /**
     * DELETE method
     *
     * @param string $path
     * @param callable $handler
     * @return void
     */
    public function delete(string $path, callable $handler): void
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    /**
     * Add route to list
     *
     * @param string $method
     * @param string $path
     * @param callable $handler
     * @return void
     */
    private function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    /**
     * Dispatch route
     *
     * @return void
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($this->convertToRegex($route['path']), $uri, $matches)) {
                array_shift($matches); // Remove the full match from the array
                $response = call_user_func_array($route['handler'], $matches);
                echo $response;
                return;
            }
        }
    }

    /**
     * Move path to regex => {id} to (\d+)
     * 
     * @param string $path
     * @return string
     */
    private function convertToRegex(string $path): string
    {
        return '#^' . preg_replace('#\{(\w+)\}#', '(\d+)', $path) . '$#';
    }
}
