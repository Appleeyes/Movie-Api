<?php

use Slim\Factory\AppFactory;

use DI\Container;



require __DIR__ . '/../vendor/autoload.php';


$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();



$app->get('/v1/movies', '\MovieApi\Controllers\MovieController:indexAction');
$app->post('/v1/movies', '\MovieApi\Controllers\MovieController:createAction');
$app->put('/v1/movies/{id}', '\MovieApi\Controllers\MovieController:updateAction');
$app->get('/v1/movies/{id}', '\MovieApi\Controllers\MovieController:deleteAction');

$app->get('/v1/posts/fake-data', '\MovieApi\Controllers\PostController:faker');

$app->run();
