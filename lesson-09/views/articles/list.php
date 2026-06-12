<h2>Articles</h2>

<a href="/articles/create">Create</a>

<ul>
    <?php foreach ($articles as $article): ?>
        <li>
            <h3>
                <?= htmlspecialchars($article['title']) ?>
            </h3>

            <p>
                <?= htmlspecialchars($article['content']) ?>
            </p>

            <a href="/articles/<?= $article['id'] ?>/edit">
                Edit
            </a>

            <form method="POST"
                action="/articles/<?= $article['id'] ?>/delete"
                style="display: inline"
                onsubmit="return confirm('Delete?')">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
