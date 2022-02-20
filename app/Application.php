<?php

namespace App;

use App\Controllers\IController;

class Application
{
    /** @var array  */
    protected $routes = [];

    /**
     * @param string $method
     * @param string $route
     * @param string $handler
     * @param string $action
     */
    public function registerRoute(string $method, string $route, string $handler, string $action)
    {
        $method = strtoupper($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }

        $this->routes[$method][$route] = [$handler, $action];
    }


    public function handleRequest()
    {
        try {
            list($class, $action) = $this->getController();
        } catch (\DomainException $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
            die;
        }

        if (!method_exists($class, $action)) {
            throw new \BadMethodCallException('Method Does not exists', 500);
        }

        $controller = (new $class);

        if (!$controller instanceof IController) {
            throw new \UnexpectedValueException('Request must be handled by IController instance ' . $class . ' was provided.');
        }

        try {
            $response = $controller->$action();
        } catch (\Throwable $exception) {
            $code = $exception->getCode() ?? 500;
            http_response_code($code);
            echo $exception->getMessage();
            die;
        }

        echo $response;
    }

    protected function getController()
    {

        $route = parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH );;
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method][$route])) {
            throw new \DomainException('Not found.', 404);
        }

        return $this->routes[$method][$route];
    }
}