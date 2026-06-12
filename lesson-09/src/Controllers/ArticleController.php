<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use PDO;
use PDOException;

class ArticleController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // List of articles
    public function index()
    {
        $query = $this->pdo->query("
            SELECT * FROM articles
            ORDER BY id DESC
        ");

        $articles = $query->fetchAll();

        echo View::render('articles/list', [
            'articles' => $articles,
            'layout' => 'layout'
        ]);
    }

    // Creation form
    public function create()
    {
        echo View::render('articles/form', [
            'article' => null,
            'isEdit' => false
        ], 'layout');
    }

    // Validation
    public function validate(array $data): array
    {
        $errors = [];

        $title = $data['title'] ?? '';
        $content = $data['content'] ?? '';

        if ($title === '') {
            $errors['title'] = 'Title required';
        }

        if ($content === '') {
            $errors['content'] = 'Content required';
        }

        return $errors;
    }

    // Storing
    public function store()
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: /articles/create");
            exit;
        }

        try {
            $query = $this->pdo->prepare("
                INSERT INTO articles (title, content)
                VALUES (:title, :content)
            ");

            $query->execute([
                ':title' => $title,
                ':content' => $content
            ]);

            $_SESSION['success'] = 'Article created';

            header("Location: /");
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // Edit form
    public function edit($id)
    {
        if ($id <= 0) die('Invalid ID');

        try {
            $query = $this->pdo->prepare("
                SELECT * FROM articles
                WHERE id = :id
            ");

            $query->execute([':id' => $id]);

            $article = $query->fetch();

            if (!$article) {
                echo 'Article not found';
                exit;
            }

            echo View::render('articles/form', [
                'article' => $article,
                'isEdit' => true
            ], 'layout');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // Updating
    public function update($id)
    {
        if ($id <= 0) die('Invalid ID');

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            header("Location: /articles/{$id}/edit");
            exit;
        }

        try {
            $query = $this->pdo->prepare("
                UPDATE articles
                SET title = :title, content = :content
                WHERE id = :id
            ");

            $query->execute([
                ':title' => $title,
                ':content' => $content,
                ':id' => $id
            ]);

            $_SESSION['success'] = 'Article updated';

            header("Location: /");
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }

    // Deleting
    public function delete($id)
    {
        if ($id <= 0) die('Invalid ID');

        try {
            $query = $this->pdo->prepare("
                DELETE FROM articles
                WHERE id = :id
            ");

            $query->execute([':id' => $id]);

            $_SESSION['success'] = 'Article deleted';
            header('Location: /');
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            header('Location: /');
            exit;
        }
    }
}
