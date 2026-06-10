<?php

declare(strict_types=1);

echo 'Server time: ' . date("Y-m-d") . ' ' . date('H:i:s');
echo 'Client IP: ' . $_SERVER['REMOTE_ADDR'];
echo 'Request method: ' . $_SERVER['REQUEST_METHOD'];


?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p>Это был POST-запрос.</p>
<?php endif; ?>

<form method="post">
    <button type="submit">Отправить POST</button>
</form>
