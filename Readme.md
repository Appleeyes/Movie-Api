# Movie Details API

The Movie Details API is a RESTful web service that allows you to manage movie details using various endpoints. This API is built using the Slim PHP framework, adheres to RESTful principles, and provides features for CRUD operations, sorting, pagination, and more.

## Table of Contents
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Usage](#usage)
- [API Documentation](#api-documentation)
- [Contributing](#contributing)
- [License](#license)

## Getting Started

### Prerequisites
Before you begin, make sure you have the following prerequisites installed on your system:
- PHP (>= 7.0)
- Composer
- MySQL Database

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/Appleeyes/Movie-Api.git

2. Navigate to the project directory:
   ```bash
   cd Movie-Api

3. Install project dependencies using Composer:
   ```bash
   composer install

4. Configure your database connection settings in `.env` file.

5. Create the necessary database tables using the `database.session.sql` file.

6. Start the development server:
   ```bash
   php -S localhost:3000 -t public

Now, the Movie Details API should be up and running locally.

## API Endpoints

The API provides the following endpoints:

- `GET /v1/movies`: Get a list of all existing movies.
- `POST /v1/movies`: Add a new movie to the collection.
- `PUT /v1/movies/{id[0-9]+}`: Update a movie by ID.
- `DELETE /v1/movies/{id[0-9]+}`: Delete a movie by ID.
- `PATCH /v1/movies/{id[0-9]+}`: Update specific data of a movie by ID.
- `GET /v1/movies/{numberPerPage}`: Get a list of movies with pagination.
- `GET /v1/movies/{numberPerPage}/sort/{fieldToSort}`: Get a list of movies sorted by a specific field with pagination.

## Usage

To use the API, you can make HTTP requests to the specified endpoints using tools like curl, Postman, or any other HTTP client. For example:

- To get a list of all movies:
  ```bash
  GET http://localhost:3000/v1/movies

- To add a new movie:
  ```bash
  POST http://localhost:3000/v1/movies
  Request Body: JSON object, form url-encoded or multipart form-data with movie details
  ```

- To update existing movie:
  ```bash
  PUT http://localhost:3000/v1/movies/2
  Request Body: JSON object, form url-encoded or multipart form-data with movie details
  ```

- To update few part of existing movie:
  ```bash
  PATCH http://localhost:3000/v1/movies/2
  Request Body: JSON object, form url-encoded or multipart form-data with movie details
  ```

- To delete existing movie:
  ```bash
  DELETE http://localhost:3000/v1/movies/2

- To get a list of movies with pagination
  ```bash
  GET http://localhost:3000/v1/movies/10

- - To get a list of movies sorted by a specific field
  ```bash
  GET http://localhost:3000/v1/movies/10/sort/title

## API Documentation

The API documentation is generated using Swagger (OpenAPI). You can access the documentation by visiting the following URL in your browser:

Swagger UI

This documentation provides detailed information about each endpoint, input parameters, response formats, and example requests/responses.

## Contributing
If you would like to contribute to this project, create a new branch.

## License
This project is licensed under the Apache License - see the [LICENSE](license) file for details.