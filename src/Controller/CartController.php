<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_show')]
    public function showCart(SessionInterface $session, ProductRepository $productRepository): Response
    {
        // Récupérer le panier de la session
        $cart = $session->get('cart', []);
        $cartProducts = [];

        // Pour chaque produit dans le panier, on récupère les informations nécessaires
        foreach ($cart as $id => $item) {
            $cartProducts[] = [
                'product' => $productRepository->find($id),
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
        }

        // Afficher la vue du panier avec les produits ajoutés
        return $this->render('cart/index.html.twig', [
            'cartProducts' => $cartProducts,
        ]);
    }
    
}
