<?php

namespace MovieApi\Middleware;

use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;


class MiddlewareBefore
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $headers = "HEADERS: " . json_encode($request->getHeaders()) . PHP_EOL;
        $body = "BODY: " . (string)$request->getBody() . PHP_EOL;
        $uri = "URI: " . $request->getUri() . PHP_EOL;
        $requestLogFileName = __DIR__ . "/../../" . $_ENV['REQUESTS_LOG_FILE'];

        file_put_contents($requestLogFileName, $uri, FILE_APPEND);
        file_put_contents($requestLogFileName, $headers, FILE_APPEND);
        file_put_contents($requestLogFileName, $body, FILE_APPEND);
        file_put_contents($requestLogFileName, PHP_EOL, FILE_APPEND);
        file_put_contents($requestLogFileName, PHP_EOL, FILE_APPEND);

        return $handler->handle($request);
    }
}
