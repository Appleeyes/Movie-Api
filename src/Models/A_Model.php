<?php

namespace MovieApi\Models;

use DI\Container;
use PDO;

abstract class A_Model
{
    private ?PDO $pdo;

    abstract function findAll(): array;

    abstract function findById(): array;

    abstract function update(array $data): bool;

    abstract function insert(array $data): bool;

    abstract function delete(int $id): bool;

    public function __construct(Container $container)
    {
        $this->pdo = $container->get('connection');
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
