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

session_start();
session_regenerate_id();

$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('Location: /login');
    return;
}

if (array_key_exists($key, $routes)) {

    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass($videoRepository);
} else {

    $controller = new Error404Controller();
}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$response = $controller->handle($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {  
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();

