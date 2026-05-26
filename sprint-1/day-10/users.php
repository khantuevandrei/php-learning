<?php

declare(strict_types=1);

$users = [
    ['name' => 'Иван', 'age' => 30, 'email' => 'ivan@example.com'],
    ['name' => 'Мария', 'age' => 25, 'email' => 'maria@example.com'],
    ['name' => 'Петр', 'age' => 17, 'email' => 'petr@example.com'],
    ['name' => 'Анна', 'age' => 42, 'email' => 'anna@example.com'],
    ['name' => 'Олег', 'age' => 15, 'email' => 'oleg@example.com'],
];

// Sort above the age of 18
$users = array_filter($users, fn($u) => $u['age'] >= 18);

// Sort by age asc
usort($users, fn($a, $b) => $a['age'] <=> $b['age']);

// Get rid of age
$users = array_map(function ($u) {
    return [
        'name' => $u['name'],
        'email' => $u['email']
    ];
}, $users);

print_r($users);
