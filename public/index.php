<?php
use App\Kernel;
require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($_ENV['APP_ENV'], (bool) $_ENV['APP_DEBUG']);
};
