<?php

use FastRoute\RouteCollector;
use Jenssegers\Blade\Blade;
use App\Middleware\Kernel;
use App\Middleware\VerifyCsrfToken;
use App\Middleware\VerifyJwtToken;
use App\Middleware\VerifySession;


$baseUri = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_URI', $baseUri);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);

require_once ROOT . 'vendor/autoload.php';


// ==========================
// 🔧 Configuración de Eloquent
// ==========================
require_once ROOT . 'config/database.php';

// ==========================
// Cargar contenedor
// ==========================
$container = require ROOT . 'bootstrap/container.php'; // Aquí obtenemos el contenedor

$kernel = new Kernel([
    VerifyCsrfToken::class,
    VerifyJwtToken::class,
    VerifySession::class,
], $container);

$blade = $container->make(Illuminate\View\Factory::class);

// ==========================
// 🚦 Configurar Rutas con FastRoute
// ==========================
$routeSetup = require ROOT . 'routes/web.php';
$dispatcher = FastRoute\simpleDispatcher($routeSetup);

// ==========================
// 🌐 Procesar la solicitud HTTP
// ==========================
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseDir = '/mvcrp';
if (strpos($uri, $baseDir) === 0) {
    $uri = substr($uri, strlen($baseDir));
}
$uri = rtrim($uri, '/');
$kernel->handle(function () use ($dispatcher, $httpMethod, $uri) {
    $routeInfo = $dispatcher->dispatch($httpMethod, empty($uri) ? '/' : $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            http_response_code(404);
            echo "404 - Ruta no encontrada";
            break;

        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            http_response_code(405);
            echo "405 - Método no permitido";
            break;

        case FastRoute\Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            if (is_callable($handler)) {
                $handler(...array_values($vars));
            } elseif (is_array($handler)) {
                [$controller, $method] = $handler;
                if (method_exists($controller, $method)) {
                    $controller->$method(...array_values($vars));
                } else {
                    http_response_code(500);
                    echo "Error: método '$method' no encontrado en el controlador";
                }
            } else {
                http_response_code(500);
                echo "Error: handler no válido";
            }
            break;
    }
});

