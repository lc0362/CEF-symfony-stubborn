<?php

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel(
        $_SERVER['APP_ENV'] ?? 'prod',
        ($_SERVER['APP_DEBUG'] ?? '0') === '1'
    );
};
