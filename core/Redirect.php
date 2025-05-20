<?php

namespace Core;

class Redirect
{
    /**
     * Redirect to a given URL.
     *
     * @param string $url
     * @param int $statusCode
     */
    public static function to($url, $statusCode = 302)
    {
        http_response_code($statusCode);
        header('Location: ' . $url);
        exit;
    }

    /**
     * Redirect back to the previous page.
     */
    public static function back()
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        self::to($referer);
    }

    /**
     * Redirect to a given URL with flash data.
     *
     * @param string $url
     * @param array $data
     * @param int $statusCode
     */
    public static function with($url, array $data = [], $statusCode = 302)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        foreach ($data as $key => $value) {
            $_SESSION['_flash'][$key] = $value;
        }

        self::to($url, $statusCode);
    }
}
