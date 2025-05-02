<?php

use Illuminate\Container\Container;
use App\Services\Auth\UserService;
use App\Repositories\Auth\UserRepository;

return function (Container $container) {
    $container->singleton(UserService::class, function ($container) {
        return new UserService($container->make(UserRepository::class));
    });
};
