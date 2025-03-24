<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Chargement du .env uniquement en local si nécessaire
if ((isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'dev') || (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'dev')) {
    if (file_exists(dirname(__DIR__).'/.env')) {
        (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
    }
}

return function (array $context) {
    return new Kernel($context['APP_ENV'] ?? 'dev', (bool) ($context['APP_DEBUG'] ?? true));
};
