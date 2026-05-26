<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Book;
use App\Services\Library;

$library = new Library();

$library->addBook(new Book('Lord of the rings', 'Tolkien', 1940));
$library->addBook(new Book('1984', 'Orwell', 1949));
$library->addBook(new Book('War and peace', 'Tolstoi', 1869));

foreach ($library->listBooks() as $book) {
    echo $book->getInfo() . "\n";
}
