<?php

session_start();

require_once __DIR__ . '/../controllers/AuthorController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../middleware.php';
require_once __DIR__ . '/../Router/Router.php';
$router = require __DIR__ . '/../routes/api.php';


list($handler, $params) = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
if ($_SERVER['REQUEST_URI'] == '/authors_books' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $authorController = new AuthorController();
    require_once __DIR__ .'/../views/authors_books.php';
}
if ($_SERVER['REQUEST_URI'] == '/users_books' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $authorController = new UserController();
    require_once __DIR__ .'/../views/users_books.php';
}
if ($handler === '/authors_books' && !isAuthenticated()) {
    header("Location: /login");
    exit();
}

if ($handler) {
    if (is_callable($handler)) {
        call_user_func_array($handler, $params);
    } else {
        list($controllerName, $actionName) = explode('@', $handler);
        $controller = new $controllerName();
        call_user_func_array([$controller, $actionName], $params);
    }
} else {
    http_response_code(404);
    echo "404 Not Found";
}
