<?php

namespace MovieApi\Models;

use DI\Container;
use Faker\Factory;
use Exception;

/**
 * @OA\Schema(
 *     schema="Movie",
 *     title="Movie",
 *     description="Movie model",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="year", type="integer"),
 *     @OA\Property(property="released", type="string"),
 *     @OA\Property(property="runtime", type="string"),
 *     @OA\Property(property="genre", type="string"),
 *     @OA\Property(property="director", type="string"),
 *     @OA\Property(property="actors", type="string"),
 *     @OA\Property(property="country", type="string"),
 *     @OA\Property(property="poster", type="string"),
 *     @OA\Property(property="imdb", type="float"),
 *     @OA\Property(property="type", type="string"),
 * )
 */
class Movie extends A_Model
{
    public int $id;
    public string $title;
    public string $year;
    public string $released;
    public string $runtime;
    public string $genre;
    public string $director;
    public string $actor;
    public string $country;
    public string $poster;
    public float $imbd;
    public string $type;
    private string $dbTableName = 'movies';

    public function findAll(): array
    {
        $sql = "SELECT * FROM " . $this->dbTableName;
        $stm = $this->getPdo()->prepare($sql);
        $stm->execute();
        $movies = $stm->fetchAll();
        return $movies;
    }

    public function findByPagination($page, $numberPerPage): array
    {
        $offset = ($page - 1) * $numberPerPage;
        $sql = "SELECT * FROM " . $this->dbTableName . " LIMIT :limit OFFSET :offset";

        $pdo = $this->getPdo();
        $stm = $pdo->prepare($sql);

        // Create separate variables to hold the values.
        $limitValue = $numberPerPage;
        $offsetValue = $offset;

        // Bind the separate variables to the statement.
        $stm->bindParam(':limit', $limitValue, \PDO::PARAM_INT);
        $stm->bindParam(':offset', $offsetValue, \PDO::PARAM_INT);

        $stm->execute();

        $movies = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $movies;
    }

    public function findSortedAndPaginated($page, $numberPerPage, $fieldToSort)
    {
        $offset = ($page - 1) * $numberPerPage;
        $sql = "SELECT * FROM " . $this->dbTableName . " ORDER BY $fieldToSort LIMIT :limit OFFSET :offset";

        $pdo = $this->getPdo();
        $stm = $pdo->prepare($sql);
        $stm->bindParam(':limit', $numberPerPage, \PDO::PARAM_INT);
        $stm->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stm->execute();

        $movies = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $movies;
    }

    public function update(array $data): bool
    {
        $sql = "UPDATE " . $this->dbTableName . " SET title=?, year=?, released=?, runtime=?, genre=?, director=?, actors=?, country=?, poster=?, imdb=?, type=? WHERE id=?";
        $stm = $this->getPdo()->prepare($sql);
        try {
            $result =
            $stm->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]]);
            return $result;
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }

    public function patch(array $data, int $id): bool
    {
        $values = [];
        $setStatements = [];

        $fieldNames = [
            'title' => 'title',
            'year' => 'year',
            'released' => 'released',
            'runtime' => 'runtime',
            'genre' => 'genre',
            'director' => 'director',
            'actors' => 'actors',
            'country' => 'country',
            'poster' => 'poster',
            'imdb' => 'imdb',
            'type' => 'type',
        ];

        foreach ($fieldNames as $fieldName => $field) {
            if (isset($data[$field])) {
                $setStatements[] = "$field = ?";
                $values[] = $data[$field];
            }
        }

        $sql = "UPDATE " . $this->dbTableName . " SET " . implode(', ', $setStatements) . " WHERE id = ?";

        $stm = $this->getPdo()->prepare($sql);

        try {
            // Bind the 'id' value to the statement.
            $values[] = $id;

            $result = $stm->execute($values);
            return $result;
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }




    public function insert(array $data): bool
    {
        $sql = "INSERT INTO " . $this->dbTableName . " (title, year, released, runtime, genre, director, actors, country, poster, imdb, type) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stm = $this->getPdo()->prepare($sql);
        try {
            $result = $stm->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]]);
            return $result;
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM " . $this->dbTableName . " WHERE id=?";
        try {
            $stm = $this->getPdo()->prepare($sql);
            $stm->execute([$id]);
        } catch (\PDOException $exception) {
            return false;
        }
        return true;
    }

    function fakeData(): bool
    {
        $faker = Factory::create('en_US');

        try {
            for ($i = 0; $i < 50; $i++) {
                $this->insert([
                    $faker->words(2, true),
                    $faker->year('now'),
                    $faker->dateTimeBetween('now', '+1 year')->format('d M Y'),
                    $faker->numberBetween(1, 300) . ' mins',
                    $faker->word,
                    $faker->name,
                    implode(', ', $faker->randomElements([$faker->name, $faker->name, $faker->name], 3)),
                    $faker->country,
                    $faker->imageUrl(200, 150),
                    number_format($faker->numberBetween(10, 100) / 10, 1),
                    $faker->word(1, true)
                ]);
            }
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }

}
