<?php

namespace App\Controllers\Api;

use Illuminate\View\Factory;
use App\Services\Auth\UserService;
use App\Controllers\Controller;
use Firebase\JWT\JWT;
use App\Support\AppContainer;

class ApiController extends Controller {

    public function __construct(
        private UserService $userService
    ) {}

    public function authUser() {
        $payload = [
            'sub' => 1,
            'email' => 'ruben28-1997@hotmail.com',
            'iat' => time(),
            'exp' => time() + (60 * 60)
        ];

        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');

        echo json_encode(['token' => $jwt]);
    }

    public function index() {
        echo json_encode(['message' => 'API index']);
    }

    public function users(int $id) {
        $user = AppContainer::get()->get('auth_user');
        $idUser = $user->sub;
        $users = $this->userService->getAllUsers();
        echo json_encode($users);
    }
}