<h2>Users</h2>

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
