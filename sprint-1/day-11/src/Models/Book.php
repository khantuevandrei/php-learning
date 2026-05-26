<?php

declare(strict_types=1);

namespace App\Models;

class Book
{
    public function __construct(
        public readonly string $title,
        public readonly string $author,
        public readonly int $year,
    ) {}

    public function getInfo(): string
    {
        return "{$this->title} - {$this->author} ({$this->year})";
    }
}
