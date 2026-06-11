<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    private static string $viewsPath;

    public static function setViewsPath(string $path): void
    {
        self::$viewsPath = $path;
    }

    public static function render(string $template, array $data = [], ?string $layout = null): string
    {
        // Transform array into variables
        extract($data);

        // Start buffering
        ob_start();

        // Connect template
        require self::$viewsPath . '/' . $template . '.php';

        // Save result to variable
        $content = ob_get_clean();

        // If layout present - wrap content
        if ($layout) {
            ob_start();

            require self::$viewsPath . '/' . $layout . '.php';

            return ob_get_clean();
        }

        // If no layout - return template
        return $content;
    }

    public static function e(string $text): string
    {
        return htmlspecialchars($text);
    }
}
