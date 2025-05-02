<?php

use Illuminate\Container\Container;
use Illuminate\View\Factory;

// ⚠️ Este archivo asume que `$blade` ya fue creado previamente en `blade.php`
require_once __DIR__ . '/../blade.php';

return function (Container $container) use ($blade) {
    $container->instance(Factory::class, $blade);
};