<?php

declare(strict_types=1);

namespace App\Core;

class Logger
{
    public static function log(string $message): void
    {
        // Path to file
        $dir = __DIR__ . '/../../logs';
        $file = $dir . '/app.log';

        // Preparing a string
        $date = date('Y-m-d H:i:s');
        $line = "[$date] $message" . PHP_EOL;

        // Checking folder
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, true)) {
                error_log($line);
                return;
            }
        }

        // Write to file
        if (@file_put_contents($file, $line, FILE_APPEND) === false) {
            error_log($line);
        }
    }
}
