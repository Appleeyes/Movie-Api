<?php

namespace MovieApi\Models;

use DI\Container;
use PDO;


class Movies
{
    private ?PDO $pdo;

    public function findAll(): array
    {
        return [];
    }

    public function findById(): array
    {
        return [];
    }

    public function update(array $data): void
    {
        return ;
    }

    public function insert(array $data): int
    {
        return '';
    }

    public function delete(int $id): bool
    {
        return '';
    }

    public function __construct(Container $container)
    {
        $this->pdo = $container->get('connection');
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
