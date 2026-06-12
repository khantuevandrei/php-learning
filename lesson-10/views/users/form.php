<h2><?= $isEdit ? 'Edit' : 'Create' ?></h2>

<form method="POST" action="<?= $isEdit ? "/users/{$user['id']}/update" : '/users/store' ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">

    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">

    <br>

    <label for="age">Age:</label>
    <input type="number" name="age" id="age" value="<?= htmlspecialchars((string) ($user['age'] ?? '')) ?>">

    <br>

    <button type="submit"><?= $isEdit ? 'Update' : 'Create' ?></button>

</form>
