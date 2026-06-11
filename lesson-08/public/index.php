<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controllers\UserController;
use App\Core\Database;
use App\Core\View;

View::setViewsPath(__DIR__ . '/../views');

try {
    $pdo = Database::getInstance();
} catch (PDOException $e) {
    echo 'Database not available.';
    exit;
}

$controller = new UserController($pdo);
$router = new Router();

// All users
$router->get('/', function () use ($controller) {
    $controller->index();
});

// Create user
$router->get('/users/create', function () use ($controller) {
    $controller->create();
});

// Save new user
$router->post('/users/store', function () use ($controller) {
    $controller->store();
});

// Edit user
$router->get('/users/{id}/edit', function ($id) use ($controller) {
    $controller->edit((int) $id);
});

// Update user
$router->post('/users/{id}/update', function ($id) use ($controller) {
    $controller->update((int) $id);
});

// Delete user
$router->post('/users/{id}/delete', function ($id) use ($controller) {
    $controller->delete((int) $id);
});

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
