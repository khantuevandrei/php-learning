<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

use PDO;

class UserController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // list of users
    public function index()
    {
        $statement = $this->pdo->query("
            SELECT * FROM users
            ORDER BY id DESC
        ");

        $users = $statement->fetchAll();

        echo View::render('users/list', [
            'users' => $users,
            'layout' => 'layout'
        ]);
    }

    // creation form
    public function create()
    {
        echo View::render('users/form', [
            'user' => null,
            'isEdit' => false
        ], 'layout');
    }

    // Validation
    private function validate(array $data): array
    {
        $errors = [];

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        if ($name === '') {
            $errors['name'] = 'Name required';
        }

        if ($email === '') {
            $errors['email'] = 'Email required';
        } elseif (!str_contains($email, '@')) {
            $errors['email'] = 'Incorrect email format';
        }

        if ($age === '') {
            $errors['age'] = 'Age required';
        } elseif ($age < 1 || $age > 120) {
            $errors['age'] = 'Age must be between 1 and 120';
        }

        return $errors;
    }

    // Creating
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        $errors = $this->validate($_POST);

        // If errors are present
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: /users/create");
            exit;
        }

        try {
            $statement = $this->pdo->prepare("
                INSERT INTO users (name, email, age)
                VALUES (:name, :email, :age)
            ");

            $statement->execute([
                ':name' => $name,
                ':email' => $email,
                ':age' => $age
            ]);

            $_SESSION['success'] = 'User created';

            header("Location: /");
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // edit form
    public function edit($id)
    {
        if ($id <= 0) die('Invalid ID');

        try {
            $statement = $this->pdo->prepare("
            SELECT * FROM users
            WHERE id = :id
        ");

            $statement->execute([':id' => $id]);

            $user = $statement->fetch();

            if (!$user) {
                echo 'User not found';
                exit;
            }

            echo View::render('users/form', [
                'user' => $user,
                'isEdit' => true
            ], 'layout');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // editing
    public function update($id)
    {
        if ($id <= 0) die('Invalid ID');

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        $errors = $this->validate($_POST);

        // If errors are present
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: /users/{$id}/edit");
            exit;
        }

        try {
            $statement = $this->pdo->prepare("
                UPDATE users
                SET name = :name, email = :email, age = :age
                WHERE id = :id
            ");

            $statement->execute([
                ':name' => $name,
                ':email' => $email,
                ':age' => $age,
                ':id' => $id
            ]);

            $_SESSION['success'] = 'User updated';

            header("Location: /");
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // Deleting
    public function delete($id)
    {
        if ($id <= 0) die('Invalid ID');

        try {
            $statement = $this->pdo->prepare("
                DELETE FROM users
                WHERE id = :id
            ");

            $statement->execute([':id' => $id]);

            $_SESSION['success'] = 'User deleted';
            header("Location: /");
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }
}
