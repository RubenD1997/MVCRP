<?php

namespace App\Controllers\Auth;

use Illuminate\View\Factory;
use App\Services\Auth\UserService;
use App\Support\CsrfToken;
use App\Controllers\Controller;

class UserController extends Controller {
    public function __construct(
        private UserService $userService
    ) {}

    public function create() {
        $this->view('users.create', [
            'csrfToken' => CsrfToken::generate()
        ]);
    }

    public function store() {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
        ];
        $this->userService->createUser($data);
        $this->redirect('/users/create');
    }
}
