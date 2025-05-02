<?php

namespace App\Services\Auth;

use App\Repositories\Auth\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers() {
        return $this->userRepository->getAll();
    }

    public function createUser(array $data): void {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->userRepository->create($data);
    }
}
