<?php

namespace App\Support;

class Utils {

    public static function helloWorld() {
        echo "Hello, World from Utils.php!";
    }

    public static function normalizeUri(string $uri): string {
        $baseDir = '/mvcrp';
        if (str_starts_with($uri, $baseDir)) {
            $uri = substr($uri, strlen($baseDir));
        }
        return '/' . ltrim($uri, '/');
    }

}