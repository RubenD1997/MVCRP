<?php

namespace App\Support;

class Session {
    
    public function __construct() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function start(): void {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public function validate(string $key): bool {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    public function remove(string $key): void {
        unset($_SESSION[$key]);
    }

    public function destroy(): void {
        session_unset();
        session_destroy();
    }
}


