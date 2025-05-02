<?php 

use FastRoute\RouteCollector;
use App\Controllers\Api\ApiController;
use App\Support\AppContainer;
use App\Middleware\VerifyJwtToken;
use App\Middleware\VerifySession;

return function (RouteCollector $r) {
    $container = AppContainer::get();
    $r->addRoute('GET', '/api/users/{id:\d+}', [$container->get(ApiController::class), 'users']);
    $r->addRoute('GET', '/api/auth', [$container->get(ApiController::class), 'authUser']);
    $r->addRoute('GET', '/api/index', [$container->get(ApiController::class), 'index']);
};