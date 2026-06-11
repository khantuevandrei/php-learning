<h2>Users</h2>

<?php if (!empty($_SESSION['success'])): ?>
    <div style="color:green">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

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

<a href="/users/create">Create</a>

<ul>
    <?php foreach ($users as $user): ?>
        <li>
            <?= htmlspecialchars($user['name']) ?>

            <a href="/users/<?= $user['id'] ?>/edit">Edit</a>

            <form method="post"
                action="/users/<?= $user['id'] ?>/delete"
                style="display:inline"
                onsubmit="return confirm('Delete?')">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach ?>
</ul>
