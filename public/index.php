<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use DI\Container;
use MovieApi\App\Database;
use BlogApi\Controllers\ExceptionController;
use BlogApi\Middleware\MiddlewareAfter;
use BlogApi\Middleware\MiddlewareBefore;
use Slim\Routing\RouteCollectorProxy;


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

$app->group('/v1', function (RouteCollectorProxy $group) {
    $group->get('/v1/movies', '\MovieApi\Controllers\MovieController:indexAction');
    $group->post('/v1/movies', '\MovieApi\Controllers\MovieController:createAction');
    $group->put('/v1/movies/{id:[0-9]+}', '\MovieApi\Controllers\MovieController:updateAction');
    $group->delete('/v1/movies/{id:[0-9]+}', '\MovieApi\Controllers\MovieController:deleteAction');
    $group->get('/v1/posts/fake-data', '\MovieApi\Controllers\PostController:faker');
});


$app->run();
