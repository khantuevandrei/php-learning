<?php

declare(strict_types=1);

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';

$errors = [];

if (empty($name)) {
    echo 'Name cannot be empty';
}

if (empty($email)) {
    echo 'Email cannot be empty';
}

if (str_contains($email, '@')) {
    echo 'Incorrect format';
}

if (empty($age)) {
    echo 'Age cannot be empty';
}

$age = (int) $age;

if ($age < 1 || $age > 120) {
    echo 'Age must be between 1 and 120';
}
