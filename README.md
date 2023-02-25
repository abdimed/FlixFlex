# Flixflex 
Flixflex is a RESTful API that allows users to register and login, and to browse different movies and Series, view details about them, watch their trailers, and manage favorites list. It is built using Laravel and the TMDb API.

### Installation:
To install Flixflex API, follow these steps:

1. Clone the repository: ``git clone https://github.com/abdimed/FlixFlex.git``
2. Install dependencies: ``composer install``
3. Create a new ``.env file: cp .env.example .env``
4. Generate an application key: ``php artisan key:generate``
5. Create a new database and update the .env file with your database credentials
6. Migrate the database: ``php artisan migrate``
7. Seed the database with sample data: ``php artisan db:seed``
8. Start the development server: ``php artisan serve``

  **Notice:** to run tests in sqlite db use: `php artisan test`  

### Usage:
Flixflex API has the following endpoints:

#####   POST /register
Registers a new user with the given details. The request body should contain the fields:

- username: (required)
- password: (required)
- password_confirmation: (required)

##### POST /login
Logs in a user with the given credentials. The request body should contain the  fields:
- username: (required)
- password: (required)

##### GET /titles
Returns a list of all titles.

##### GET /titles/{title}/
Returns information about the title with the specified ID.

##### GET /search
Searches for titles that match the given query. The query string should be provided as a parameter called **keyword**.

##### GET /titles/{title}/trailer
Returns the trailer URL for the title with the specified ID.

##### GET /user/favorites
Returns a list of all titles that have been favorited by the authenticated user.

##### POST /user/favorites/{title}/store
Adds the title with the specified ID to the authenticated user's list of favorites.

##### POST /user/favorites/{title}/delete
Removes the title with the specified ID from the authenticated user's list of favorites.

## Notice:
- To run tests use: `php artisan test`, Tests will run on memory using SQLITE.  
- I chose to create one model Called **Title** instead of movies or series, the Title records an enum column called `type` that contains the type of the title either movie or serie.
- I used **Laravel Sanctum**  for authenfication as it offers a simple way to authenticate. 

#### Author: 
- Name : Mohammed ABDI.
- Email : mohammed.abdi.dev@gmail.com
- GitHub: https://github.com/abdimed.
- LinkedIn: https://www.linkedin.com/in/mohammed-abdi-86847b1a1/
