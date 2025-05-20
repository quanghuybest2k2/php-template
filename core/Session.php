<?php

namespace Core;

class Session
{
    public static function getFlash($key, $default = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $value = $_SESSION['_flash'][$key] ?? $default;

        // remove after getting the value
        unset($_SESSION['_flash'][$key]);

        return $value;
    }

    public static function hasFlash($key)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['_flash'][$key]);
    }
}
