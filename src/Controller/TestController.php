<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController
{
    #[Route('/ping', name: 'ping')]
    public function ping(): Response
    {
        return new Response('pong');
    }
}
