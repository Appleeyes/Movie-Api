<?php

namespace MovieApi\Models;

use DI\Container;
use Faker\Factory;
use Exception;

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
    public string $imbd;
    public string $type;
    private string $dbTableName = 'movies';

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

    public function insert(array $data): void
    {
        $sql = "INSERT INTO " . $this->dbTableName . " (title, year, released, runtime, genre, director, actors, country, poster, imdb, type) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stm = $this->getPdo()->prepare($sql);
        $stm->execute([$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10]]);
    }

    public function delete(int $id): bool
    {
        return '';
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
