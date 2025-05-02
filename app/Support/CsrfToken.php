<?php

namespace App\Support;

class CsrfToken {

    public function __construct() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    public static function generate(): string {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }

    public static function verify(string $token): bool {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION['_csrf_token']) && hash_equals($_SESSION['_csrf_token'], $token);
    }

    public static function reset(): void {
        unset($_SESSION['_csrf_token']);
    }
}
