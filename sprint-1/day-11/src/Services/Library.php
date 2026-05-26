<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Book;

class Library
{
    private array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function listBooks(): array
    {
        return $this->books;
    }
}
