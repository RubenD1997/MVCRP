<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Illuminate\View\Compilers\BladeCompiler;

// Paths
$viewsPath = __DIR__ . '/../resources/views';
$cachePath = __DIR__ . '/../storage/cache';

// Crear contenedor
$container = new Container;

// Registrar BladeCompiler
$container->singleton('blade.compiler', function () use ($cachePath) {
    return new BladeCompiler(new Filesystem, $cachePath);
});

// Resolver de motores de vista
$engineResolver = new EngineResolver;
$engineResolver->register('blade', function () use ($container) {
    return new CompilerEngine($container->make('blade.compiler'));
});

// Finder de vistas
$viewFinder = new FileViewFinder(new Filesystem, [$viewsPath]);

// Instanciar fábrica de vistas
$blade = new Factory($engineResolver, $viewFinder, new Dispatcher($container));

return $blade;
