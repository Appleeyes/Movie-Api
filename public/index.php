<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

use DI\Container;
use MovieApi\App\Database;



require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->safeLoad();

$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set('connection', function () {
    $db = new Database();
    return $db->connection;
});

$app->get('/v1/movies', '\MovieApi\Controllers\MovieController:indexAction');
$app->post('/v1/movies', '\MovieApi\Controllers\MovieController:createAction');
$app->put('/v1/movies/{id}', '\MovieApi\Controllers\MovieController:updateAction');
$app->get('/v1/movies/{id}', '\MovieApi\Controllers\MovieController:deleteAction');

$app->get('/v1/posts/fake-data', '\MovieApi\Controllers\PostController:faker');

$app->run();
