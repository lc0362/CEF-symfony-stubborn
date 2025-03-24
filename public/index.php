<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $env = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'prod';
    $debug = filter_var($_SERVER['APP_DEBUG'] ?? $_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
    
    return new Kernel($env, $debug);
};
