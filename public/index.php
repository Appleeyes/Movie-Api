<?php

use Slim\Factory\AppFactory;
use Dotenv;
use MovieApi\App\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../vendor/autoload.php';

// Create a new Slim app instance
$app = AppFactory::create();

// Load environment variables from .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Create an instance of the Database class with database configuration
$database = new Database(
    $_ENV['DB_HOST'],
    $_ENV['DB_DATABASE'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
);

// Get the PDO database connection
$pdo = $database->getConnection();

// Define a middleware for JSON responses

// $app->add(function (Request $request, RequestHandler $handler) use ($app) {
//     $response = $handler->handle($request);
//     return $response->withHeader('Content-Type', 'application/json');
// });