<?php if ($user): ?>
    <h2>Thanks, <?= htmlspecialchars($user['name']) ?></h2>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Age: <?= htmlspecialchars($user['age']) ?></p>
<?php else: ?>
    <p>No data</p>
<?php endif; ?>
