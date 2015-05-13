<?php

require 'vendor/autoload.php';

use League\Route\RouteCollection as Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require 'src/functions.php';
$router = new Router();

$router->get('/details/{id}', 'VU\App\Controllers\PhotoController::show');
$router->get('/', 'VU\App\Controllers\PhotoController::index');
$router->get('/{path}', function(Request $request, Response $response) {
    return new Response(null, 404);
});

$dispatcher = $router->getDispatcher();
$request = Request::createFromGlobals();

$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();
