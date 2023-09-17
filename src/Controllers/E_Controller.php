<?php

namespace MovieApi\Controllers;

use MovieApi\Middleware\MiddlewareAfter;
use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class E_Controller extends A_Controller
{
    public function notFound(Request $request, Response $response): Response
    {
        $middleware = new MiddlewareAfter();
        $payload = json_encode(['status' => 404, 'message' => 'not found'], JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);
        $response->withStatus(StatusCodeInterface::STATUS_NOT_FOUND);
        $response->withHeader('Content-Type', 'application/json');
        $middleware->logResponse($response);
        return $response;
    }

    public function indexAction(Request $request, Response $response): Response
    {
        return ($response);
    }

    public function createAction(Request $request, Response $response): Response
    {
        return ($response);
    }

    public function updateAction(Request $request, Response $response, $args = []): Response
    {
        return ($response);
    }

    public function deleteAction(Request $request, Response $response, $args = []): Response
    {
        return ($response);
    }
}
