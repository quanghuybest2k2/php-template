<?php

namespace App\utils;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    private static $logger = null;

    private static function init()
    {
        $logFile = __DIR__ . '/../logs/app-' . date('Y-m-d') . '.log';

        if (!file_exists(dirname($logFile))) {
            mkdir(dirname($logFile), 0777, true);
        }

        if (self::$logger === null) {
            self::$logger = new MonoLogger("daily");

            // Log to terminal
            $streamHandler = new StreamHandler("php://stdout");
            self::$logger->pushHandler($streamHandler);

            // Log to file
            $fileHandler = new StreamHandler($logFile, MonoLogger::DEBUG);
            self::$logger->pushHandler($fileHandler);
        }
    }

    public static function emergency(string $message, array $context = [])
    {
        self::init();
        self::$logger->emergency($message, $context);
    }

    public static function alert(string $message, array $context = [])
    {
        self::init();
        self::$logger->alert($message, $context);
    }

    public static function critical(string $message, array $context = [])
    {
        self::init();
        self::$logger->critical($message, $context);
    }

    public static function error(string $message, array $context = [])
    {
        self::init();
        self::$logger->error($message, $context);
    }

    public static function warning(string $message, array $context = [])
    {
        self::init();
        self::$logger->warning($message, $context);
    }

    public static function notice(string $message, array $context = [])
    {
        self::init();
        self::$logger->notice($message, $context);
    }

    public static function info(string $message, array $context = [])
    {
        self::init();
        self::$logger->info($message, $context);
    }

    public static function debug(string $message, array $context = [])
    {
        self::init();
        self::$logger->debug($message, $context);
    }
}
