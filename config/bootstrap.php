<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (!isset($_SERVER['APP_ENV'])) {
    if (file_exists(dirname(__DIR__) . '/.env')) {
        (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
    } else {
        $_SERVER['APP_ENV'] = 'prod';
    }
}
