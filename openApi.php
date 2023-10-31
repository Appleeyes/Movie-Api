openapi: 3.0.0
info:
  title: 'Movie API'
  version: 1.0.0
paths:
  /v1/movies:
    get:
      tags:
        - Movies
      summary: 'Get a list of all movies'
      operationId: 6b618a01573f44bc7c91374600ce8ed2
      responses:
        '200':
          description: 'Successful operation'
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schema/Movie'
    post:
      tags:
        - Movies
      summary: 'Create a new movie'
      operationId: 649329485d56f2e3572c25572eb47b30
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/Movie'
      responses:
        '201':
          description: 'Movie created successfully'
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schemas/Movie'
        '400':
          description: 'Bad request'
  '/v1/movies/{numberPerPage}':
    get:
      tags:
        - Movies
      summary: 'Get a list of movies with pagination'
      operationId: de029b70a91d487a36df6500b6b59fda
      parameters:
        -
          name: numberPerPage
          in: path
          required: true
          schema:
            type: integer
        -
          name: page
          in: query
          schema:
            type: integer
            default: 1
      responses:
        '200':
          description: 'Successful operation'
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schemas/Movie'
        '400':
          description: 'Bad request'
  '/v1/movies/{numberPerPage}/sort/{fieldToSort}':
    get:
      tags:
        - Movies
      summary: 'Get a list of movies sorted by a field'
      operationId: 6a807b585ff9b1cd2bc03b5a1c3467fe
      parameters:
        -
          name: numberPerPage
          in: path
          required: true
          schema:
            type: integer
        -
          name: fieldToSort
          in: path
          required: true
          schema:
            type: string
        -
          name: page
          in: query
          schema:
            type: integer
            default: 1
      responses:
        '200':
          description: 'Successful operation'
          content:
            application/json:
              schema:https://github.com/swagger-api/swagger-ui.git
                type: array
                items:
                  $ref: '#/components/schemas/Movie'
        '400':
          description: 'Bad request'
  '/v1/movies/{id}':
    put:
      tags:
        - Movies
      summary: 'Update a movie by ID'
      operationId: d0c2f4cdb436934c9900e83d62705f08
      parameters:
        -
          name: id
          in: path
          required: true
          schema:
            type: integer
      requestBody:
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/Movie'
      responses:
        '201':
          description: 'Movie updated successfully'
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schemas/Movie'
        '400':
          description: 'Bad request'
    delete:
      tags:
        - Movies
      summary: 'Delete a movie by ID'
      operationId: ff44153bc4fada606f000c20742885fe
      parameters:
        -
          name: id
          in: path
          required: true
          schema:
            type: integer
      responses:
        '200':
          description: 'Movie deleted successfully'
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: '#/components/schemas/Movie'
        '400':
          description: 'Bad request'
