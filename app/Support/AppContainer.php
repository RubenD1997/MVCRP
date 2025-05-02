<?php

namespace App\Support;

use Illuminate\Container\Container;

class AppContainer {
    
    protected static $container;

    public static function set(Container $container) {
        self::$container = $container;
    }

    public static function get() {
        return self::$container;
    }

    public static function make($abstract, $parameters = []) {
        return self::$container->make($abstract, $parameters);
    }
}
