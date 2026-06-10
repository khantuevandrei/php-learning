<?php

declare(strict_types=1);

session_start();

require 'Database.php';

$pdo = null;

try {
    $pdo = Database::getInstance();
} catch (PDOException $e) {
    echo "Database not available.";
    exit;
}

// POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $age = (int) $age;
    $errors = [];

    // Validate data
    if ($name === '') {
        $errors['name'] = 'Name cannot be empty';
    }

    if ($email === '') {
        $errors['email'] = 'Email cannot be empty';
    } elseif (!str_contains($email, '@')) {
        $errors['email'] = 'Incorrect format';
    }

    if ($age === '') {
        $errors['age'] = 'Age cannot be empty';
    } elseif ($age < 1 || $age > 120) {
        $errors['age'] = 'Age must be between 1 and 120';
    }

    // Save errors/data to session and redirect
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit;
    }

    // INSERT
    $statement = $pdo->prepare("
        INSERT INTO users (name, email, age)
        VALUES (:name, :email, :age)
    ");

    $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':age' => $age
    ]);

    $_SESSION['success'] = true;

    header("Location: index.php?action=success");
    exit;
}

// GET handling
$action = $_GET['action'] ?? null;
$errors = $_SESSION['errors'] ?? [];
$user = $_SESSION['user'] ?? null;

// clean data
unset($_SESSION['errors']);

// Success
if ($action === 'success') {
    try {
        $stmt = $pdo->query("
            SELECT * FROM users
            ORDER BY id DESC
            LIMIT 1
        ");

        $user = $stmt->fetch();
    } catch (PDOException $e) {
        echo 'Could not load user data';
        exit;
    }

    require 'success.php';
    exit;
}

// Default
try {
    $stmt = $pdo->query("
        SELECT * FROM users
        ORDER BY id DESC
    ");

    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Error loading users';
    exit;
}

require 'form.php';
