<?php

namespace App\Controller;

use App\Service\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PaymentController extends AbstractController
{
    #[Route('/cart/checkout', name: 'cart_checkout')]
    public function checkout(SessionInterface $session, StripeService $stripeService): Response
    {
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            $this->addFlash('warning', 'Votre panier est vide.');
            return $this->redirectToRoute('cart_show');
        }

        // Calcul du total du panier
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Stripe attend des centimes (€ => *100)
        $amountInCents = intval($total * 100);

        // Création du paiement Stripe (simulation)
        $paymentIntent = $stripeService->createPaymentIntent($amountInCents);

        // En vrai tu stockerais paymentIntent dans ta base ou tu le retournerais côté JS
        dump($paymentIntent);

        // On vide le panier après le paiement
        $session->remove('cart');

        $this->addFlash('success', 'Commande finalisée en mode test avec Stripe !');

        return $this->redirectToRoute('cart_confirmation');
    }

    #[Route('/cart/confirmation', name: 'cart_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('cart/confirmation.html.twig');
    }
    
    #[Route('/create-checkout-session', name: 'create_checkout_session')]
    public function createCheckoutSession(SessionInterface $session, StripeService $stripeService): JsonResponse
    {
        $cart = $session->get('cart', []);

        dd($_ENV, $_SERVER);

    
        if (empty($cart)) {
            return new JsonResponse(['error' => 'Panier vide'], 400);
        }
    
        // Calcul du total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $amountInCents = intval($total * 100);
    
        // Création de la session Stripe
        $checkoutSession = $stripeService->createCheckoutSession($amountInCents);
    
        return new JsonResponse([
            'sessionId' => $checkoutSession->id,
            'publicKey' => $this->getParameter('stripe_public_key'),
        ]);
    }
    
    

}
