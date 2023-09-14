<?php

use Slim\Routing\RouteCollectorProxy;

$app->group('/v1/movies', function (RouteCollectorProxy $group) {
    // Get list of all existing movies
    $group->get('', '\MovieApi\Controllers\MovieController:listMovies');

    // Add a new movie to the collection
    $group->post('', '\MovieApi\Controllers\MovieController:addMovie');

    // Update a movie by {id}
    $group->put('/{id}', '\MovieApi\Controllers\MovieController:updateMovie');

    // Delete a movie by {id}
    $group->delete('/{id}', '\MovieApi\Controllers\MovieController:deleteMovie');

    // Update particular data of a movie by {id}
    $group->patch('/{id}', '\MovieApi\Controllers\MovieController:patchMovie');

    // Get list of {numberPerPage} existing movies
    $group->get('/{numberPerPage}', '\MovieApi\Controllers\MovieController:listMoviesWithPagination');

    // Get list of {numberPerPage} existing movies sorted by {fieldToSort}
    $group->get('/{numberPerPage}/sort/{fieldToSort}', '\MovieApi\Controllers\MovieController:listMoviesWithSorting');
});