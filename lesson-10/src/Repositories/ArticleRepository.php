<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class ArticleRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $query = $this->pdo->query("
            SELECT * FROM articles
            ORDER BY id DESC
        ");

        return $query->fetchAll();
    }

    public function find(int $id): ?array
    {
        $query = $this->pdo->prepare("
            SELECT * FROM articles
            WHERE id = :id
        ");

        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    public function create(array $data)
    {
        $query = $this->pdo->prepare("
                INSERT INTO articles (title, content)
                VALUES (:title, :content)
            ");

        $query->execute([
            ':title' => $data['title'],
            ':content' => $data['content']
        ]);
    }

    public function update(int $id, array $data)
    {
        $query = $this->pdo->prepare("
            UPDATE articles
            SET title = :title, content = :content
            WHERE id = :id
        ");

        $query->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':id' => $id
        ]);
    }

    public function delete(int $id)
    {
        $query = $this->pdo->prepare("
            DELETE FROM articles
            WHERE id = :id
        ");

        $query->execute([':id' => $id]);
    }
}
