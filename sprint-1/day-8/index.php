<?php
$title = "My first PHP page";
$name = "Student";
$currentTime = date('H:i:s');
$greeting = date('H') < 12 ? 'Good morning' : (date('H') < 18 ? 'Good day' : 'Good evening');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <h1><?= $greeting  ?>, <?= $name ?></h1>
    <p>Current time: <?= $currentTime ?></p>

    <p>Today is <?= date('d.m.Y') ?></p>
</body>

</html>