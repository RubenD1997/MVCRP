<?php

namespace App\Middleware;

use App\Support\Session;
use App\Support\Utils;

class VerifySession {

    protected array $only = [
        '/api/auth',
    ];

    public function __construct(private Session $session) {}

    public function handle(callable $next) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = Utils::normalizeUri($uri);

        if (!in_array($uri, $this->only)) {
            return $next(); 
        }

        if (!$this->session->validate('user')) {
            http_response_code(401);
            echo "Acceso no autorizado. Por favor inicie sesión.";
            exit;
        }
        return $next();
    }
}
