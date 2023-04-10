<?php

namespace Router;

class Router
{
    private $routes = [];

    public function add($method, $pattern, $handler)
    {
        $this->routes[$method . ':' . $pattern] = $handler;
    }

    public function match($method, $uri)
    {
        foreach ($this->routes as $route => $handler) {
            list($routeMethod, $routePattern) = explode(':', $route, 2);

            if ($method === $routeMethod && preg_match('#^' . $routePattern . '$#', $uri, $params)) {
                array_shift($params);
                return [$handler, $params];
            }
        }

        return [null, []];
    }
}
