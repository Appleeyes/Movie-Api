<?php

namespace MovieApi\Controllers;

use DI\Container;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

abstract class A_Controller
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function render(array $data, Response $response): Response
    {
        $payload = json_encode($data, JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);
        error_log("Response payload: " . $payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    protected function getRequestBodyAsArray(Request $request): array
    {
        $requestBody = explode('&', urldecode($request->getBody()->getContents()));
        $requestBodyParsed = [];
        foreach ($requestBody as $item) {
            $itemTmp = explode('=', $item);
            $requestBodyParsed[$itemTmp[0]] = $itemTmp[1];
        }
        return $requestBodyParsed;
    }

    abstract function indexAction(Request $request, Response $response): Response;

    abstract function createAction(Request $request, Response $response): Response;

    abstract function updateAction(Request $request, Response $response, $args = []): Response;

    abstract function deleteAction(Request $request, Response $response, $args = []): Response;
}
