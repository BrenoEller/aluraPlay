<?php

use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Repository\VideoRepositorio;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/connection-db.php';

$videoRepository = new VideoRepositorio($pdo);

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$routes = require_once __DIR__ . '/../config/routes.php';

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {

    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);
} else {

    $controller = new Error404Controller();
}

$controller->processaRequisicao();