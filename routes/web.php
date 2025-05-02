
<?php

use FastRoute\RouteCollector;

// Requiere las rutas de los módulos
$inicioRoutes = require __DIR__ . '/inicio.php';
$authRoutes = require __DIR__ . '/auth.php';
$apiRoutes = require __DIR__ . '/api.php';

// Configura las rutas de cada módulo
return function (RouteCollector $r) use ($inicioRoutes, $authRoutes, $apiRoutes) {
    $inicioRoutes($r);
    $authRoutes($r);
    $apiRoutes($r);
};
