<?php 

use App\Support\Session;
use Illuminate\Container\Container;

return function (Container $container) {
    $container->singleton(Session::class, function () {
        return new Session();
    });
    $container->bind(VerifySession::class, function (Container $c) {
        return new VerifySession($c->get(Session::class));
    });
};