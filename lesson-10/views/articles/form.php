<h2><?= $isEdit ? 'Edit' : 'Create' ?></h2>

<form method="POST"
    action="<?= $isEdit ? "/articles/{$article['id']}/update" :
                "/articles/store" ?>">
    <label for="title">Title:</label>
    <input type="text"
        name="title"
        id="title"
        value="<?= htmlspecialchars($article['title'] ?? '') ?>">

    <br>

    <label for="content">Content:</label>
    <input type="text"
        name="content"
        id="content"
        value="<?= htmlspecialchars($article['content'] ?? '') ?>">

    <br>

    <button type="submit">
        <?= $isEdit ? 'Update' : 'Create' ?>
    </button>

</form>
