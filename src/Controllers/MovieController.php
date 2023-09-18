<?php

namespace MovieApi\Controllers;

use MovieApi\Models\Movie;
use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;



class MovieController extends A_Controller
{

    public function indexAction(Request $request, Response $response): Response
    {
        $movies = new Movie($this->container);
        $parsedBody = $movies->findAll();
        return $this->render($parsedBody, $response);
    }

    public function paginateAction(Request $request, Response $response, $args = [])
    {
        $numberPerPage = $args['numberPerPage'];

        // Use array indexing to access the 'page' query parameter.
        $page = 1;

        $movies = new Movie($this->container);
        $parsedBody = $movies->findByPagination($page, $numberPerPage);

        return $this->render($parsedBody, $response);
    }


    public function createAction(Request $request, Response $response): Response
    {
        if ($request->getHeaderLine('Content-Type') === 'application/json') {
            $jsonBody = json_decode($request->getBody(), true);

            if ($jsonBody === null) {
                $responseStatus = [
                    'status' => StatusCodeInterface::STATUS_BAD_REQUEST,
                    'message' => 'Invalid JSON data'
                ];
                return $this->render($responseStatus, $response);
            }

            // Validate and sanitize JSON data here
            $title = filter_var($jsonBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $year = filter_var($jsonBody['year'], FILTER_SANITIZE_NUMBER_INT);
            $genre = filter_var($jsonBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $director = filter_var($jsonBody['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $actors = filter_var($jsonBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $country = filter_var($jsonBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $released = filter_var($jsonBody['released'], FILTER_SANITIZE_SPECIAL_CHARS);
            $runtime = filter_var($jsonBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($jsonBody['poster'], FILTER_SANITIZE_STRING);
            $imdb = filter_var($jsonBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            $type = filter_var($jsonBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        } else {
            $parsedBody = $request->getParsedBody();

            $title = filter_var($parsedBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $year = filter_var($parsedBody['year'], FILTER_SANITIZE_NUMBER_INT);
            $genre = filter_var($parsedBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $director = filter_var($parsedBody['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $actors = filter_var($parsedBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $country = filter_var($parsedBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $released = filter_var($parsedBody['released'], FILTER_SANITIZE_SPECIAL_CHARS);
            $runtime = filter_var($parsedBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($parsedBody['poster'], FILTER_SANITIZE_STRING);
            $imdb = filter_var($parsedBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            $type = filter_var($parsedBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        }
        $movies = new Movie($this->container);
        $inserted = $movies->insert([
            $title, $year, $released, $runtime, $genre, $director, $actors, $country, $poster, $imdb, $type
        ]);

        if ($inserted) {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_CREATED,
                'message' => 'Movie added successfully'
            ];
        } else {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to add movie'
            ];
        }
        return $this->render($responseStatus, $response);
    }


    public function updateAction(Request $request, Response $response, $args = []): Response
    {
        if ($request->getHeaderLine('Content-Type') === 'application/json') {
            $jsonBody = json_decode($request->getBody(), true);

            if ($jsonBody === null) {
                $responseStatus = [
                    'status' => StatusCodeInterface::STATUS_BAD_REQUEST,
                    'message' => 'Invalid JSON data'
                ];
                return $this->render($responseStatus, $response);
            }

            // Validate and sanitize JSON data here
            $id = $args['id'];
            $title = filter_var($jsonBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $year = filter_var($jsonBody['year'], FILTER_SANITIZE_NUMBER_INT);
            $genre = filter_var($jsonBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $director = filter_var($jsonBody['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $actors = filter_var($jsonBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $country = filter_var($jsonBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $released = filter_var($jsonBody['released'], FILTER_SANITIZE_SPECIAL_CHARS);
            $runtime = filter_var($jsonBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($jsonBody['poster'], FILTER_SANITIZE_STRING);
            $imdb = filter_var($jsonBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            $type = filter_var($jsonBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        } else {
            $parsedBody = $this->getRequestBodyAsArray($request);

            $id = $args['id'];
            $title = filter_var($parsedBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $year = filter_var($parsedBody['year'], FILTER_SANITIZE_NUMBER_INT);
            $genre = filter_var($parsedBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $director = filter_var($parsedBody['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $actors = filter_var($parsedBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $country = filter_var($parsedBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            $released = filter_var($parsedBody['released'], FILTER_SANITIZE_SPECIAL_CHARS);
            $runtime = filter_var($parsedBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($parsedBody['poster'], FILTER_SANITIZE_STRING);
            $imdb = filter_var($parsedBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            $type = filter_var($parsedBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
        }
        $movies = new Movie($this->container);
        $inserted = $movies->update([
            $title, $year, $released, $runtime, $genre, $director, $actors, $country, $poster, $imdb, $type, $id
        ]);

        if ($inserted) {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_CREATED,
                'message' => 'Movie updated successfully'
            ];
        } else {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to update movie'
            ];
        }
        return $this->render($responseStatus, $response);
    }

    public function patchAction(Request $request, Response $response, $args = []): Response
    {
        $id = $args['id'];

        // var_dump($id);

        if ($request->getHeaderLine('Content-Type') === 'application/json') {
            $jsonBody = json_decode($request->getBody(), true);

            if ($jsonBody === null) {
                $responseStatus = [
                    'status' => StatusCodeInterface::STATUS_BAD_REQUEST,
                    'message' => 'Invalid JSON data'
                ];
                return $this->render($responseStatus, $response);
            }

            $fieldsToUpdate = [];

            // Validate and sanitize JSON data here
            if (isset($jsonBody['title'])) {
                $fieldsToUpdate['title'] = filter_var($jsonBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['year'])) {
                $fieldsToUpdate['year'] = filter_var($jsonBody['year'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (isset($jsonBody['genre'])) {
                $fieldsToUpdate['genre'] = filter_var($jsonBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['released'])) {
                $fieldsToUpdate['released'] = filter_var($jsonBody['released'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['runtime'])) {
                $fieldsToUpdate['runtime'] = filter_var($jsonBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['director'])) {
                $fieldsToUpdate['director'] = filter_var($jsonBody['director'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['actors'])) {
                $fieldsToUpdate['actors'] = filter_var($jsonBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['country'])) {
                $fieldsToUpdate['country'] = filter_var($jsonBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($jsonBody['poster'])) {
                $fieldsToUpdate['poster'] = filter_var($jsonBody['poster'], FILTER_SANITIZE_URL);
            }
            if (isset($jsonBody['imdb'])) {
                $fieldsToUpdate['imdb'] = filter_var($jsonBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            }
            if (isset($jsonBody['type'])) {
                $fieldsToUpdate['type'] = filter_var($jsonBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }

        } else {
            // Handle form-data or URL-encoded request as needed
            $parsedBody = $this->getRequestBodyAsArray($request);

            

            // Define an array to store the fields to update
            $fieldsToUpdate = [];

            // Validate and sanitize form-data or URL-encoded data here
            if (isset($parsedBody['title'])) {
                $fieldsToUpdate['title'] = filter_var($parsedBody['title'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($parsedBody['year'])) {
                $fieldsToUpdate['year'] = filter_var($parsedBody['year'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (isset($parsedBody['genre'])) {
                $fieldsToUpdate['genre'] = filter_var($parsedBody['genre'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($parsedBody['released'])) {
                $fieldsToUpdate['released'] = filter_var($parsedBody['released'],
                    FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING
                );
            }
            if (isset($parsedBody['runtime'])) {
                $fieldsToUpdate['runtime'] = filter_var($parsedBody['runtime'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($parsedBody['director'])) {
                $fieldsToUpdate['director'] = filter_var($parsedBody['director'],
                    FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING
                );
            }
            if (isset($parsedBody['actors'])) {
                $fieldsToUpdate['actors'] = filter_var($parsedBody['actors'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($parsedBody['country'])) {
                $fieldsToUpdate['country'] = filter_var($parsedBody['country'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
            if (isset($parsedBody['poster'])) {
                $fieldsToUpdate['poster'] = filter_var($parsedBody['poster'], FILTER_SANITIZE_URL);
            }
            if (isset($parsedBody['imdb'])) {
                $fieldsToUpdate['imdb'] = filter_var($parsedBody['imdb'], FILTER_SANITIZE_NUMBER_FLOAT);
            }
            if (isset($parsedBody['type'])) {
                $fieldsToUpdate['type'] = filter_var($parsedBody['type'], FILTER_SANITIZE_SPECIAL_CHARS | FILTER_SANITIZE_STRING);
            }
        }

        $movies = new Movie($this->container);

        // Update only the fields that were provided in the request
        $updated = $movies->patch($fieldsToUpdate, $id);

        if ($updated) {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_OK,
                'message' => 'Movie updated successfully'
            ];
        } else {
            $responseStatus = [
                'status' => StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to update movie'
            ];
        }

        return $this->render($responseStatus, $response);
    }

    public function deleteAction(Request $request, Response $response, $args = []): Response
    {
        $id = $args['id'];
        $movies = new Movie($this->container);
        $movies->delete($id);
        $responseData = [
            'status' => StatusCodeInterface::STATUS_OK,
            'message' => 'Movie deleted successfully'
        ];
        return $this->render($responseData, $response);
    }

    function faker(Request $Request, Response $response): Response
    {
        $movies = new Movie($this->container);
        $movies->fakeData($this->container);
        $responseData = [
            'status' => StatusCodeInterface::STATUS_OK,
            'message' => 'Fake p$parsedBody generated successfully'
        ];

        return $this->render($responseData, $response);
    }
}
