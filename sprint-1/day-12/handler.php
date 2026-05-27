<?php

declare(strict_types=1);
session_start();

// Check if request came from POST, otherwise redirect back to form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /form.php');
    exit;
}

// Gathering the data
$name = trim($POST['name'] ?? '');
$email = trim($_POST['email'] ??  '');
$pass = $_POST['password'] ??  '';
$confirmPass = $_POST['confirm-password'] ?? '';

// Validation
$eerors = [];

if ($name === '') {
    $errors[] = 'Name is required';
} elseif (mb_strlen($name) < 2) {
    $errors[] = 'Name must be at least of 2 characters';
}

if ($email === '') {
    $errors[] = 'Email is required';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Wrong email format';
}

if ($pass === '') {
    $errors[] = 'Password is required';
}

if ($confirmPass === '') {
    $errors[] = 'Confirm the password';
}

if ($pass !== $confirmPass) {
    $errors[] = 'Passwords do not match';
}

// If errors are present - redirect back to form
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red'>$error</p>";
    }
}

// Saving flash to session
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => "Registration successful. Welcome, $name"
];

// Redirecting to success page
header('Location: /success.php');
exit;
