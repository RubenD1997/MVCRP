<?php

use Illuminate\Container\Container;
use App\Repositories\Auth\UserRepository;

return function (Container $container) {
    $container->singleton(UserRepository::class, function () {
        return new UserRepository();
    });
};
