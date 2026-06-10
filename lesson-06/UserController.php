<?php

declare(strict_types=1);

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

        require 'views/list.php';
    }

    // creation form
    public function create()
    {
        $user = null;

        require 'views/form.php';
    }

    // creating
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';
        $errors = [];

        // Validation
        if ($name === '') {
            $errors['name'] = 'Name required';
            $_SESSION['errors'] = $errors;
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

        // If errors are present
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: index.php?action=create");
            exit;
        }

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

        header("Location: index.php");
        exit;
    }

    // edit form
    public function edit($id)
    {
        $statement = $this->pdo->prepare("
            SELECT * FROM users
            WHERE id = :id
        ");

        $statement->execute([':id' => $id]);

        $user = $statement->fetch();

        require 'views/form.php';
    }

    // editing
    public function update($id)
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';
        $errors = [];

        // Validation
        if ($name === '') {
            $errors['name'] = 'Name required';
            $_SESSION['errors'] = $errors;
        }

        if ($email === '') {
            $errors['email'] = 'Email required';
        } elseif (!str_contains($email, '@')) {
            $errors['email'] = 'Incorrect email format';
        }

        if ($age === '') {
            $errors['age'] = 'Age required';
        } elseif ($age < 1 || $age > 120) {
            $errors['age'] = 'Must be between 1 and 120';
        }

        // If errors are present
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: index.php?action=edit&id=$id");
            exit;
        }

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

        header("Location: index.php");
        exit;
    }

    // Deleting
    public function delete($id)
    {
        $statement = $this->pdo->prepare("
            DELETE FROM users
            WHERE id = :id
        ");

        $statement->execute([':id' => $id]);

        $_SESSION['success'] = 'User deleted';
        header("Location: index.php");
        exit;
    }
}
