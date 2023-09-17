<?php

namespace MovieApi\App;

use PDO;
use PDOException;

final class Database
{
    public ?PDO $connection = null;

    public function __construct()
    {
        if ($this->connection == null) {
            $dbHost = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_DATABASE'];
            $dbUser = $_ENV['DB_USERNAME'];
            $dbPassword = $_ENV['DB_PASSWORD'];
            $dsn = "mysql:host=$dbHost;dbname=$dbName";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->connection = new PDO($dsn, $dbUser, $dbPassword, $options);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
    }
}
