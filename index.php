<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use App\Router;

$router = new Router();
$router->dispatch();

