<?php

namespace App\config;

use PDO;
use PDOException;
use App\config\Env;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $pdo = null;

    private string $host;
    private string $db;
    private string $user;
    private string $pass;
    private function __construct()
    {
        Env::loadEnv(__DIR__ . '/../.env');

        $this->host = getenv('DB_HOST');
        $this->db   = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Connect to the database using PDO.
     * @throws \Exception
     */
    private function connect(): void
    {
        if ($this->pdo !== null) {
            return;
        }

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db}",
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception('Database connection failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get the PDO object to query the database.
     * @return PDO
     */
    public function getConnection(): PDO
    {
        $this->connect();
        return $this->pdo;
    }

    /**
     * Get the PDO object to query the database.
     * @return PDO
     * @throws \Exception
     */
    public static function getPdo(): PDO
    {
        return self::getInstance()->getConnection();
    }

    // Prevent cloning and unserializing
    public function __clone() {}
    public function __wakeup() {}
}
