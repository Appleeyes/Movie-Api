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

    abstract function indexAction(Request $request, Response $response): Response;

    abstract function createAction(Request $request, Response $response): Response;

    abstract function updateAction(Request $request, Response $response, $args = []): Response;

    abstract function deleteAction(Request $request, Response $response, $args = []): Response;
}
