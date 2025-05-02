<?php

use FastRoute\RouteCollector;
use App\Controllers\Inicio\InicioController;
use App\Support\AppContainer;

return function (RouteCollector $r) {
    
    $container = AppContainer::get();

    $r->addRoute('GET', '/', [$container->get(InicioController::class), 'index']);
    $r->addRoute('GET', '/about', [$container->get(InicioController::class), 'about']);
};
