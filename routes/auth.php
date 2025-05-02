<?php 

use FastRoute\RouteCollector;
use App\Controllers\Auth\UserController;
use App\Support\AppContainer;

return function (RouteCollector $r) {
    
    $container = AppContainer::get();

    $r->addRoute('GET', '/users/create', [$container->get(UserController::class), 'create']);
    $r->addRoute('POST', '/users/store', [$container->get(UserController::class), 'store']);
};