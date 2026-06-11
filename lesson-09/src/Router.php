<?php

declare(strict_types=1);

namespace App;

class Router
{
    private array $routes = [];

    // GET handler
    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    // POST handler
    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    // Invoker
    public function dispatch(string $method, string $uri): void
    {
        // Remove everything after '?'
        $uri = strtok($uri, '?');

        $route = $this->match($method, $uri);

        if ($route === null) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        call_user_func_array($route['handler'], $route['params']);
    }

    // Extract {id}
    private function match(string $method, string $uri): ?array
    {
        // Look for exact match
        if (isset($this->routes[$method][$uri])) {
            return [
                'handler' => $this->routes[$method][$uri],
                'params' => []
            ];
        }

        // Look through all routes to find a match
        foreach ($this->routes[$method] as $path => $handler) {
            // Conditionals
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\d+)', $path);
            $pattern = '#^' . '$#';

            // Checking matches
            if (preg_match($pattern, $uri, $matches)) {
                // Keep only string params
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                return [
                    'handler' => $handler,
                    'params' => $params
                ];
            }
        }

        // If nothing found
        return null;
    }
}
