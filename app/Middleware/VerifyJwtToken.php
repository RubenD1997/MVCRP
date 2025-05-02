<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Support\AppContainer;
use App\Support\Utils;

class VerifyJwtToken {

    protected array $only = [
        '/api/users/{id}',
    ];

    protected string $secret;

    public function __construct() {
        $this->secret = $_ENV['JWT_SECRET'] ?? 'clave_secreta';
    }

    public function handle(callable $next) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = Utils::normalizeUri($uri);
        $requiresAuth = false;
        foreach ($this->only as $protected) {
            $protected = preg_replace('/{\w+}/', '\d+', $protected); 
            if (preg_match("#^$protected$#", $uri)) {
                $requiresAuth = true;
                break;
            }
        }

        if (!$requiresAuth) {
            return $next();
        }

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        // Si no se proporciona el token
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(['error' => 'Token no proporcionado']);
            exit;
        }

        $token = $matches[1];

        try {
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            AppContainer::get()->instance('auth_user', $decoded);
            return $next();
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido', 'message' => $e->getMessage()]);
            exit;
        }
    }
}

