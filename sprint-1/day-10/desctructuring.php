<?php

declare(strict_types=1);

$book = ['title' => 'Мастер и Маргарита', 'author' => 'Булгаков', 'year' => 1940, 'pages' => 480];

// Take an array, destructure title & author and use in a string
['title' => $title, 'author' => $author] = $book;

echo 'Book ' . '"' . $title . '"' . 'was written by ' . $author . '.';
