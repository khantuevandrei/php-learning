<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Repositories\ArticleRepository;
use PDOException;

class ArticleController extends Controller
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    // List of articles
    public function index()
    {
        $articles = $this->repository->all();

        $this->view('articles/list', ['articles' => $articles]);
    }

    // Creation form
    public function create()
    {
        $this->view('articles/form', [
            'article' => null,
            'isEdit' => false
        ]);
    }

    // Validation
    protected function validate(array $data): array
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

            $this->redirect('/articles/create');
        }

        try {
            $this->repository->create([
                'title' => $title,
                'content' => $content
            ]);

            $_SESSION['success'] = 'Article created';

            $this->redirect('/');
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            $this->redirect('/');
        }
    }

    // Edit form
    public function edit($id)
    {
        if ($id <= 0) $this->notFound('Invalid ID');

        try {
            $article = $this->repository->find($id);

            if (!$article) {
                $this->notFound('Article not found');
            }

            $this->view('articles/form', [
                'article' => $article,
                'isEdit' => true
            ]);
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            $this->redirect('/');
        }
    }

    // Updating
    public function update($id)
    {
        if ($id <= 0) $this->notFound('Invalid ID');

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $this->redirect("/articles/{$id}/edit");
        }

        try {
            $this->repository->update($id, [
                'title' => $title,
                'content' => $content
            ]);

            $_SESSION['success'] = 'Article updated';

            $this->redirect('/');
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            $this->redirect('/');
        }
    }

    // Deleting
    public function delete($id)
    {
        if ($id <= 0) $this->notFound('Invalid ID');

        try {
            $this->repository->delete($id);

            $_SESSION['success'] = 'Article deleted';
            $this->redirect('/');
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            $this->redirect('/');
        }
    }
}
