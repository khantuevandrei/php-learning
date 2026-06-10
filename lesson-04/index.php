<?php

declare(strict_types=1);

session_start();

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
        exit();
    } else {
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'age' => $age
        ];
        header('Location: index.php?action=success');
        exit();
    }
}

// GET handling
$action = $_GET['action'] ?? null;
$errors = $_SESSION['errors'] ?? [];
$user = $_SESSION['user'] ?? null;

// clean data
unset($_SESSION['errors']);

//routes
if ($action === 'success') {
    require 'success.php';
} else {
    require 'form.php';
}
