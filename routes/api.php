<?php

use Router\Router;

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AuthorController.php';
require_once __DIR__ . '/../controllers/BookController.php';
require_once __DIR__ . '/../controllers/GenreController.php';

$userController = new UserController();
$authorController = new AuthorController();
$bookController = new BookController();
$genreController = new GenreController();

$router = new Router();

// User routes
$router->add('GET', '/users', 'UserController@index');
$router->add('GET', '/users/(\d+)', 'UserController@show');
$router->add('POST', '/users', 'UserController@create');
$router->add('PUT', '/users/(\d+)', 'UserController@update');
$router->add('DELETE', '/users/(\d+)', 'UserController@delete');

// Author routes
$router->add('GET', '/authors', 'AuthorController@index');
$router->add('GET', '/authors/(\d+)', 'AuthorController@show');
$router->add('POST', '/authors', 'AuthorController@create');
$router->add('PUT', '/authors/(\d+)', 'AuthorController@update');
$router->add('DELETE', '/authors/(\d+)', 'AuthorController@delete');

// Book routes
$router->add('GET', '/books', 'BookController@index');
$router->add('GET', '/books/(\d+)', 'BookController@show');
$router->add('POST', '/books', 'BookController@create');
$router->add('PUT', '/books/(\d+)', 'BookController@update');
$router->add('DELETE', '/books/(\d+)', 'BookController@delete');

// Genre routes
$router->add('GET', '/genres', 'GenreController@index');
$router->add('GET', '/genres/(\d+)', 'GenreController@show');
$router->add('POST', '/genres', 'GenreController@create');
$router->add('PUT', '/genres/(\d+)', 'GenreController@update');
$router->add('DELETE', '/genres/(\d+)', 'GenreController@delete');

// Auth routes
$router->add('GET', '/login', function () {
    include __DIR__ . '/../views/login.php';
});

$router->add('GET', '/register', function () {
    include __DIR__ . '/../views/register.php';
});

$router->add('GET', '/authors_books', function () {
    include __DIR__ . '/../views/authors_books.php';
});
$router->add('GET', '/users_books', function () {
    include __DIR__ . '/../views/users_books.php';
});

$router->add('POST', '/register', 'UserController@register');
$router->add('POST', '/login', 'UserController@login');

return $router;
