<?php

declare(strict_types=1);

$daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

$user = ['name' => 'John', 'age' => 32, 'email' => 'john@example.com'];

$users = [
    ['name' => 'Clint', 'age' => 19, 'email' => 'clint@example.com'],
    ['name' => 'Eva', 'age' => 22, 'email' => 'eva@example.com'],
    ['name' => 'Mary', 'age' => 26, 'email' => 'mary@example.com'],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td><?= $user['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
