<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <form action="index.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <?php if (!empty($errors['name'])): ?>
            <div style="color:red"><?= $errors['name'] ?></div>
        <?php endif; ?>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <?php if (!empty($errors['email'])): ?>
            <div style="color:red"><?= $errors['email'] ?></div>
        <?php endif; ?>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age">
        <?php if (!empty($errors['age'])): ?>
            <div style="color:red"><?= $errors['age'] ?></div>
        <?php endif; ?>
        <button type="submit">Send</button>
    </form>
</body>

</html>
