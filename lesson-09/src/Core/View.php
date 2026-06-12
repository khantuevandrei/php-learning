<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    private static string $viewsPath;

    public static  function setViewsPath(string $path): void
    {
        self::$viewsPath = $path;
    }

    public static function render(string $template, array $data = [], ?string $layout = null): string
    {
        extract($data);

        ob_start();

        require self::$viewsPath . '/' . $template . '.php';

        $content = ob_get_clean();

        if ($layout) {
            ob_start();

            require self::$viewsPath . '/' . $layout . '.php';

            return ob_get_clean();
        }

        return $content;
    }
}
