<?php

namespace App\Controllers\Inicio;

use App\Services\Auth\UserService;
use App\Support\Utils;
use App\Controllers\Controller;

class InicioController extends Controller {

    public function __construct(private UserService $userService) {}

    public function index() {
        $usuarios = $this->userService->getAllUsers();
        $this->view('inicio.index', ['usuarios' => $usuarios]);
    }

    public function about() {
        $this->view('inicio.about', []);
    }
}
