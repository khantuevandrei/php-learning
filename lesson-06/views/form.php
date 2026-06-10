<?php
$isEdit = $user !== null;
?>

<h2><?= $isEdit ? 'Edit' : 'Create' ?></h2>

<?php if (!empty($_SESSION['errors'])): ?>
    <ul>
        <?php foreach ($_SESSION['errors'] as $key => $value): ?>
            <li style="color:red">
                <?= $value ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form method="POST" action="index.php?action=<?= $isEdit ? 'update&id=' . $user['id'] : 'store' ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name">

    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email">

    <br>

    <label for="age">Age:</label>
    <input type="number" name="age" id="age">

    <br>

    <button type="submit"><?= $isEdit ? 'Update' : 'Create' ?></button>

</form>
