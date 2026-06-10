<?php

declare(strict_types=1);

session_start();

require 'Database.php';
require 'UserController.php';

$pdo = Database::getInstance();
$controller = new UserController($pdo);

$action = $_GET['action'] ?? null;
$id = (int) ($_GET['id'] ?? 0);

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'update':
        $controller->update($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->index();
}
