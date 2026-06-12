<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Logger;
use App\Repositories\UserRepository;
use PDOException;

class UserController extends Controller
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    // List of users
    public function index()
    {
        $users = $this->repository->all();

        $this->view('users/list', ['users' => $users]);
    }

    // Creation form
    public function create()
    {
        $this->view('users/form', [
            'user' => null,
            'isEdit' => false
        ]);
    }

    // Validation
    protected function validate(array $data): array
    {
        $errors = [];

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        if ($name === '') {
            $errors['name'] = 'Name required';
        }

        if ($email === '') {
            $errors['email'] = 'Email required';
        } elseif (!str_contains($email, '@')) {
            $errors['email'] = 'Incorrect email format';
        }

        if ($age === '') {
            $errors['age'] = 'Age required';
        } elseif ($age < 1 || $age > 120) {
            $errors['age'] = 'Age must be between 1 and 120';
        }

        return $errors;
    }

    // Storing
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $this->redirect('/users/create');
        }

        try {
            $this->repository->create([
                'name' => $name,
                'email' => $email,
                'age' => $age
            ]);

            $_SESSION['success'] = 'User created';

            $this->redirect('/users');
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
            $user = $this->repository->find($id);

            if (!$user) {
                $this->notFound('User not found');
            }

            $this->view('users/form', [
                'user' => $user,
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

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $age = $_POST['age'] ?? '';

        $errors = $this->validate($_POST);

        // If errors are present
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            $this->redirect("/users/{$id}/edit");
        }

        try {
            $this->repository->update($id, [
                'name' => $name,
                'email' => $email,
                'age' => $age
            ]);

            $_SESSION['success'] = 'User updated';

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

            $_SESSION['success'] = 'User deleted';
            $this->redirect('/');
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            $this->redirect('/');
        }
    }
}
