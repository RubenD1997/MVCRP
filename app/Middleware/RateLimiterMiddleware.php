<?php

namespace App\Middleware;

use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\RateLimiter\Storage\CacheStorage;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class RateLimiterMiddleware {
    
    protected RateLimiterFactory $factory;

    public function __construct() {
        $redis = RedisAdapter::createConnection('redis://localhost:6379');
        $cache = new RedisAdapter($redis);
        $storage = new CacheStorage($cache);
        $this->factory = new RateLimiterFactory([
            'id' => 'global_limit',
            'policy' => 'fixed_window',
            'limit' => 20,
            'interval' => '60 seconds',
        ], $storage);
    }

    public function handle(callable $next) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $limiter = $this->factory->create($ip);
        $limit = $limiter->consume(1);
        if (!$limit->isAccepted()) {
            http_response_code(429);
            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'Demasiadas peticiones. Intenta nuevamente más tarde.',
                'retry_after_seconds' => $limit->getRetryAfter()->getTimestamp() - time()
            ]);
            exit;
        }
        return $next();
    }
}

