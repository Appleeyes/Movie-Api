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
        $contentType = $request->getHeaderLine('Content-Type');
        $parseddata = $request->getParsedBody();

        switch ($contentType) {
            case 'application/json':
                $data = json_decode($request->getBody(), true);
                break;

            case 'application/x-www-form-urlencoded':
                $data = $parseddata;
                break;

            case 'multipart/form-data':
                $data = $_POST;
                break;

            default:
                $responseStatus = [
                    'status' => StatusCodeInterface::STATUS_UNSUPPORTED_MEDIA_TYPE,
                    'message' => 'Unsupported content type: ' . $contentType
                ];
                return $this->render($responseStatus, $response);
        }

        // Validate required fields
        $requiredFields = ['title', 'year', 'genre', 'director', 'actors', 'country'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                $responseStatus = [
                    'status' => StatusCodeInterface::STATUS_BAD_REQUEST,
                    'message' => 'Missing required field'
                ];
                return $this->render($responseStatus, $response);
            }
        }

        $title = filter_var($data['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        $year = filter_var($data['year'], FILTER_SANITIZE_NUMBER_INT);
        $genre = filter_var($data['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        $director = filter_var($data['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        $actors = filter_var($data['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        $country = filter_var($data['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);

        // Optional fields
        $released = isset($data['released']) ? filter_var($data['released'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $runtime = isset($data['runtime']) ? filter_var($data['runtime'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $poster = isset($data['poster']) ? filter_var($data['poster'], FILTER_SANITIZE_STRING) : null;
        $imdb = isset($data['imdb']) ? filter_var($data['imdb'], FILTER_SANITIZE_NUMBER_FLOAT) : null;
        $type = isset($data['type']) ? filter_var($data['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING) : null;

        
        $movies = new Movie($this->container);
        $inserted = $movies->insert([
            $title, $year, $released, $runtime, $genre, $director, $actors, $country, $poster, $imdb, $type
        ]);

        if ($inserted) {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_CREATED,
                'message' => 'Movie added successfully'
            ];
            return $this->render($responseStatus, $response);
        } else {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to add movie'
            ];
            return $this->render($responseStatus, $response);
        }
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
