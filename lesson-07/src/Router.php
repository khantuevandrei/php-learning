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

    // Invoker method
    public function dispatch(string $method, string $uri): void
    {
        // Remove all after '?'
        $uri = strtok($uri, '?');

        $route = $this->match($method, $uri);

        if ($route === null) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        call_user_func_array($route['handler'], $route['params']);
    }

    // Helper to recognize {id}
    private function match(string $method, string $uri): ?array
    {
        // First look for a match
        if (isset($this->routes[$method][$uri])) {
            return [
                'handler' => $this->routes[$method][$uri],
                'params' => []
            ];
        }

        // Go through all paths & find a template with {params}
        foreach ($this->routes[$method] as $path => $handler) {
            // Transform {id} into regex
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>\d+)', $path);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                // Keep only string keys
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return [
                    'handler' => $handler,
                    'params' => $params
                ];
            }
        }

        return null; // Nothing is found
    }
}
