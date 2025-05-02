<?php

namespace App\Repositories\Auth;

use App\Models\Auth\User;

class UserRepository {
    
    public function getAll() {
        return User::all();  
    }

    public function create(array $data): void {
        User::create($data);
    }
}
