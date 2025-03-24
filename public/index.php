<?php

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel(
        $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'prod',
        (bool) ($_ENV['APP_DEBUG'] ?? $_SERVER['APP_DEBUG'] ?? false)
    );
};
