<?php

namespace App\config;

class Env
{
    /**
     * Load environment variables from a file into environment.
     *
     * @param string $filePath
     * @return void
     */
    public static function loadEnv(string $filePath): void
    {
        if (!file_exists($filePath)) return;

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (str_starts_with($line, '#')) continue;

            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);

                // Remove comments
                $value = preg_replace('/\s+#.*/', '', $value);

                putenv(trim($key) . '=' . trim($value));
            }
        }
    }
}
