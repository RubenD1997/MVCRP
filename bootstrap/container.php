<?php

use Illuminate\Container\Container;
use App\Support\AppContainer;

$container = new Container();

foreach (glob(__DIR__ . '/bindings/*.php') as $file) {
    $binding = require $file;
    if (is_callable($binding)) {
        $binding($container);
    }
}

AppContainer::set($container);

return $container;

