<?php

declare(strict_types=1);

session_start();

$file = $_FILES['avatar'] ?? null;

if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
    die('File upload error');
}

if ($file['size'] > 2 * 1024 * 1024) {
    die('File too large');
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimieType = $finfo->file($file['tmp_name']);

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($mimieType, $allowedTypes)) {
    die('Wrong file type');
}

$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$newName = uniqid('avatar_', true) . '.' . $extension;

$uploadDir = __DIR__ . '/uploads';
$destination = $uploadDir . '/' . $newName;

move_uploaded_file($file['tmp-name'], $destination);

echo "File uploaded as $newName";
