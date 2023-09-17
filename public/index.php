<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response;
use DI\Container;
use MovieApi\App\Database;
use MovieApi\Controllers\E_Controller;
use MovieApi\Middleware\MiddlewareAfter;
use MovieApi\Middleware\MiddlewareBefore;
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
    $group->get('/movies', '\MovieApi\Controllers\MovieController:indexAction');
    $group->post('/movies', '\MovieApi\Controllers\MovieController:createAction');
    $group->put('/movies/{id:[0-9]+}', '\MovieApi\Controllers\MovieController:updateAction');
    $group->delete('/movies/{id:[0-9]+}', '\MovieApi\Controllers\MovieController:deleteAction');
    $group->get('/movies/fake-data', '\MovieApi\Controllers\MovieController:faker');
})->add(new MiddlewareBefore())->add(new MiddlewareAfter());

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setErrorHandler(
    Slim\Exception\HttpNotFoundException::class,
    function (Psr\Http\Message\ServerRequestInterface $request) use ($container) {
        $exception = new E_Controller($container);
        return $exception->notFound($request, new Response());
    }
);

$app->run();