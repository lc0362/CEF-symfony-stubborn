<?php

use Symfony\Component\Dotenv\Dotenv;
use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Charger le .env uniquement en local
if (file_exists(dirname(__DIR__).'/.env')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
