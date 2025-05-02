<?php

namespace App\Middleware;

use Illuminate\Container\Container;

class Kernel {
    protected array $middleware = [];
    protected Container $container;

    public function __construct(array $middleware = [], Container $container = null) {
        $this->middleware = $middleware;
        $this->container = $container;
    }

    public function handle(callable $finalHandler) {
        $middlewareStack = array_reverse($this->middleware);

        $next = $finalHandler;

        foreach ($middlewareStack as $middlewareClass) {
            $container = $this->container;
            $next = function () use ($middlewareClass, $next, $container) {
                $middleware = $container->get($middlewareClass);
                return $middleware->handle($next);
            };
        }

        return $next();
    }
}

