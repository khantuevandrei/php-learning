<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <h1>Registration</h1>

    <form action="/handler.php" method="POST" novalidate>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required minlength="2">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm-password">Confirm password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <button type="submit">Register</button>
    </form>

</body>

</html>