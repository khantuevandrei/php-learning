<?php

declare(strict_types=1);

// Start the session
session_start();

// Init the counter
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}

// Handle the reset
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['visits'] = 0;
    header('Location: counter.php');
    exit;
}

// Increment only for GET requests
$_SESSION['visits']++;

// Read flash message
$flash = $_SESSION['flash'] ?? null;

// Delete after reading
unset($_SESSION['flash']);

echo "You visited {$_SESSION['visits']} times";
