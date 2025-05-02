<?php

namespace App\Controllers;

use Illuminate\View\Factory;
use App\Support\AppContainer;


class Controller {


    public function __construct() {}

    /**
     * Renderizar una vista con Blade.
     */
    protected function view($template, $data = []) {
        $blade = AppContainer::get()->make(Factory::class);
        echo $blade->make($template, $data)->render();
    }

    /**
     * Redireccionar a otra URL.
     */
    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

    /**
     * Obtener valores del request (GET o POST).
     */
    protected function input(string $key, $default = null) {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }
}
