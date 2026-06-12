<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $query = $this->pdo->query("
            SELECT * FROM users
            ORDER BY id DESC
        ");

        return $query->fetchAll();
    }

    public function find(int $id): ?array
    {
        $query = $this->pdo->prepare("
            SELECT * FROM users
            WHERE id = :id
        ");

        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    public function create(array $data)
    {
        $query = $this->pdo->prepare("
            INSERT INTO users (name, email, age)
            VALUES (:name, :email, :age)
        ");

        $query->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':age' => $data['age']
        ]);
    }

    public function update(int $id, array $data)
    {
        $query = $this->pdo->prepare("
            UPDATE users
            SET name = :name, email = :email, age = :age
            WHERE id = :id
        ");

        $query->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':age' => $data['age'],
            ':id' => $id
        ]);
    }

    public function delete(int $id)
    {
        $query = $this->pdo->prepare("
            DELETE FROM users
            WHERE id = :id
        ");

        $query->execute([':id' => $id]);
    }
}
