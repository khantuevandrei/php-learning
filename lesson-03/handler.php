<?php

declare(strict_types=1);

if ($_SERVER['REQUEST METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$age = (int) $age;

$errors = [];

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

if (!empty($errors)) {
    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($errror) . "</li>";
    }

    echo "</ul>";
} else {
    echo "Thank you, " . htmlspecialchars($name) . " data recieved.";
}
