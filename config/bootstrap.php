<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if ($_SERVER['APP_ENV'] === 'dev' && file_exists(dirname(__DIR__) . '/.env')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}
