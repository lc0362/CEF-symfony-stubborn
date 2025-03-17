<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestEmailController extends AbstractController
{
    #[Route('/test-email', name: 'test_email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('fromtest@mailtrap.io')
            ->to('totest@mailtrap.io')
            ->subject("Confirmation d'inscription")
            ->text('Email bien envoyé lors de la création du compte User');

        $mailer->send($email);

        return new Response("Email envoyé !");
    }
}
