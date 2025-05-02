<?php

use Illuminate\Container\Container;
use App\Controllers\Inicio\InicioController;
use App\Controllers\Auth\UserController;
use App\Services\Auth\UserService;
use App\Controllers\Api\ApiController;

return function (Container $container) {
    $container->singleton(InicioController::class, function ($container) {
        return new InicioController($container->make(UserService::class));
    });
    $container->singleton(UserController::class, function ($container) {
        return new UserController($container->make(UserService::class));
    });
    $container->singleton(ApiController::class, function ($container) {
        return new ApiController($container->make(UserService::class));
    });
};
