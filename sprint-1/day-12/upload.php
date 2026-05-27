<?php

declare(strict_types=1);

$message = '';
$error = '';

// Обработка загрузки только для POST-запросов
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['avatar'] ?? null;

    // Проверка: был ли файл загружен
    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
        $error = 'Файл не выбран';
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'Ошибка загрузки файла (код: ' . $file['error'] . ')';
    } elseif ($file['size'] > 1 * 1024 * 1024) {
        $error = 'Файл слишком большой (максимум 1 МБ)';
    } else {
        // Проверка реального MIME-типа
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']); // ← tmp_name, не tmp-name!

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($mimeType, $allowedTypes)) { // ← добавил ! (отрицание)
            $error = 'Недопустимый тип файла: ' . $mimeType;
        } else {
            // Всё ок — сохраняем
            $uploadDir = __DIR__ . '/uploads';

            // Создаем папку, если её нет
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newName = uniqid('avatar_', true) . '.' . $extension;
            $destination = $uploadDir . '/' . $newName;

            move_uploaded_file($file['tmp_name'], $destination);
            $message = "Файл загружен как $newName";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка аватара</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
        }

        button {
            padding: 10px 20px;
            background: #3182ce;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #2c5282;
        }

        .success {
            color: #276749;
            background: #f0fff4;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .error {
            color: #c53030;
            background: #fff5f5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .preview {
            max-width: 200px;
            margin-top: 16px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <h1>Загрузка аватара</h1>

    <?php if ($message): ?>
        <div class="success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="avatar">Выберите изображение:</label>
            <input
                type="file"
                id="avatar"
                name="avatar"
                accept="image/png, image/jpeg">
        </div>
        <button type="submit">Загрузить</button>
    </form>

    <?php if ($message && isset($destination)): ?>
        <p>Предпросмотр:</p>
        <img src="uploads/<?= htmlspecialchars($newName) ?>" alt="Аватар" class="preview">
    <?php endif; ?>
</body>

</html>