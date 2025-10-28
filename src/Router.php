<?php

namespace App;

class Router {
    private $routes = [];

    public function __construct() {
        $this->routes = [
            '/' => [AuthController::class, 'landing'],
            '/auth/login' => [AuthController::class, 'login'],
            '/auth/signup' => [AuthController::class, 'signup'],
            '/auth/logout' => [AuthController::class, 'logout'],
            '/auth/loginAction' => [AuthController::class, 'loginAction'],
            '/auth/signupAction' => [AuthController::class, 'signupAction'],
            '/dashboard' => [DashboardController::class, 'index'],
            '/tickets' => [TicketsController::class, 'index'],
            '/tickets/create' => [TicketsController::class, 'createAction'],
            '/tickets/edit' => [TicketsController::class, 'editAction'],
            '/tickets/delete' => [TicketsController::class, 'deleteAction'],
        ];
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$uri])) {
            http_response_code(404);
            die('404 Not Found');
        }

        [$controllerName, $action] = $this->routes[$uri];
        
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                http_response_code(404);
                die('Method not found');
            }
        } else {
            http_response_code(404);
            die('Controller not found');
        }
    }
}

