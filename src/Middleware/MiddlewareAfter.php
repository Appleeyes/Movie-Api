<?php

namespace MovieApi\Middleware;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class MiddlewareAfter
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $this->logResponse($handler->handle($request));
        return $handler->handle($request);
    }

    public function logResponse(Response $response): void
    {
        $headers = "HEADERS: " . json_encode($response->getHeaders()) . PHP_EOL;
        $body = "BODY: " . (string)$response->getBody() . PHP_EOL;
        $statusCode = "STATUS CODE: " . $response->getStatusCode() . PHP_EOL;
        $responseLogFileName = __DIR__ . "/../../" . $_ENV['RESPONSE_LOG_FILE'];

        file_put_contents($responseLogFileName, $statusCode, FILE_APPEND);
        file_put_contents($responseLogFileName, $headers, FILE_APPEND);
        file_put_contents($responseLogFileName, $body, FILE_APPEND);
        file_put_contents($responseLogFileName, PHP_EOL, FILE_APPEND);
        file_put_contents($responseLogFileName, PHP_EOL, FILE_APPEND);
    }
}
