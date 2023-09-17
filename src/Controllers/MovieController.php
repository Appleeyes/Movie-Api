<?php

namespace MovieApi\Controllers;

use MovieApi\Models\Movie;
use Fig\Http\Message\StatusCodeInterface;
use MovieApi\Models\Movies;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class MovieController extends A_Controller
{

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

    function faker(Request $request, Response $response): Response
    {
        $movies = new Movie($this->container);
        $movies->fakeData($this->container);
        $responseData = [
            'status' => StatusCodeInterface::STATUS_OK,
            'message' => 'Fake data generated successfully'
        ];

        return $this->render($responseData, $response);
    }
}
