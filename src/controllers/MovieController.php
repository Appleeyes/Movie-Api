<?php

// src/controllers/MovieController.php

namespace MovieApi\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MovieController
{
    // Define your route handlers here

    public function listMovies(Request $request, Response $response): Response
    {
        // Implement logic to list all movies
    }

    public function addMovie(Request $request, Response $response): Response
    {
        // Implement logic to add a new movie
    }

    public function updateMovie(Request $request, Response $response, array $args): Response
    {
        // Implement logic to update a movie by {id}
    }

    public function deleteMovie(Request $request, Response $response, array $args): Response
    {
        // Implement logic to delete a movie by {id}
    }

    // Implement other route handlers as needed
}
