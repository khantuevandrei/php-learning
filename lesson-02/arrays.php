<?php

declare(strict_types=1);

$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

echo $daysOfWeek[1];

$user = ['name' => 'John', 'age' => 32, 'email' => 'john@example.com'];

echo $user['email'];

$users = [
    ['name' => 'Clint', 'age' => 19, 'email' => 'clint@example.com'],
    ['name' => 'Eva', 'age' => 22, 'email' => 'eva@example.com'],
    ['name' => 'Mary', 'age' => 26, 'email' => 'mary@example.com'],
];

echo $users[1]['name'];
echo $users[2]['email'];
