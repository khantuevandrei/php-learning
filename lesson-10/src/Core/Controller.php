<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\View;

abstract class Controller
{
    // Render
    protected function view(string $template, array $data = []): void
    {
        echo View::render($template, $data, 'layout');
    }

    // Redirect
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    // 404
    protected function notFound(string $message): void
    {
        http_response_code(404);
        echo $message;
        exit;
    }

    // Validation
    abstract protected function validate(array $data): array;
}
