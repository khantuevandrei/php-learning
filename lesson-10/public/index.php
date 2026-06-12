<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controllers\ArticleController;
use App\Controllers\UserController;
use App\Core\Database;
use App\Core\View;

View::setViewsPath(__DIR__ . '/../views');

try {
    $pdo = Database::getInstance();
} catch (PDOException $e) {
    echo 'Database not available';
    exit;
}

$aController = new ArticleController($pdo);
$uController = new UserController($pdo);
$router = new Router();

// All articles
$router->get('/', function () use ($aController) {
    $aController->index();
});

// Create article
$router->get('/articles/create', function () use ($aController) {
    $aController->create();
});

// Store new article
$router->post('/articles/store', function () use ($aController) {
    $aController->store();
});

// Edit article
$router->get('/articles/{id}/edit', function ($id) use ($aController) {
    $aController->edit((int) $id);
});

// Update article
$router->post('/articles/{id}/update', function ($id) use ($aController) {
    $aController->update((int) $id);
});

// Delete article
$router->post('/articles/{id}/delete', function ($id) use ($aController) {
    $aController->delete((int) $id);
});

// All users
$router->get('/users', function () use ($uController) {
    $uController->index();
});

// Create user
$router->get('/users/create', function () use ($uController) {
    $uController->create();
});

// Save new user
$router->post('/users/store', function () use ($uController) {
    $uController->store();
});

// Edit user
$router->get('/users/{id}/edit', function ($id) use ($uController) {
    $uController->edit((int) $id);
});

// Update user
$router->post('/users/{id}/update', function ($id) use ($uController) {
    $uController->update((int) $id);
});

// Delete user
$router->post('/users/{id}/delete', function ($id) use ($uController) {
    $uController->delete((int) $id);
});

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
