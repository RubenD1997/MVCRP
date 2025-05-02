<?php

namespace App\Middleware;

use App\Support\CsrfToken;
use App\Support\Utils;

class VerifyCsrfToken {

    protected array $only = [
        '/users/store'
    ];

    public function __construct() {}

    public function handle(callable $next) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = Utils::normalizeUri($uri);

        if (!in_array($uri, $this->only)) {
            return $next(); 
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_token'] ?? '';

            if (!CsrfToken::verify($token)) {
                http_response_code(403);
                exit('Token CSRF inválido');
            }

            CsrfToken::reset();
        }

        return $next();
    }
}