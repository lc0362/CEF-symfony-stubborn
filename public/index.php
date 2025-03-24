<?php

use App\Kernel;

putenv('APP_ENV=prod');
putenv('APP_DEBUG=0');


require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    $env = $_SERVER['APP_ENV'] ?? 'prod';
    $debug = (bool) ($_SERVER['APP_DEBUG'] ?? false);

    return new Kernel($env, $debug);
};
