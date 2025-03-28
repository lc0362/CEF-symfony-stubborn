<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_show')]
    public function showCart(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $cartProducts = [];
    
        foreach ($cart as $id => $item) {
            $cartProducts[] = [
                'product' => $productRepository->find($id), 
                'quantity' => $item['quantity'], 
                'price' => $item['price'], 
                'size' => $item['size'], 
            ];
        }
    
        // Afficher la vue du panier avec les produits ajoutés
        return $this->render('cart/index.html.twig', [
            'cartProducts' => $cartProducts, 
        ]);
    }
    
    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function addToCart(Product $product, SessionInterface $session, Request $request): Response
    {
        // Récupérer le panier de la session
        $cart = $session->get('cart', []);

        // Récupérer la taille et la quantité depuis la requête
        $size = $request->get('size');
        $quantity = $request->get('quantity', 1);

        // Vérifier si la taille est spécifiée
        if (!$size) {
            return new Response('Erreur: Veuillez sélectionner une taille.', 400);
        }

        // Création d'une clé spécifique avec l'id du produit + sa taille
        $productKey = $product->getId() . '_' . $size;

        // Si le produit avec cette taille est déjà dans le panier, on incrémente la quantité
        if (isset($cart[$productKey])) {
            $cart[$productKey]['quantity']++;
        } else {
            // Sinon on ajoute le produit avec la taille et la quantité
            $cart[$productKey] = [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $product->getPrice(),
                'size' => $size,
            ];
        }

        // Sauvegarder le panier dans la session
        $session->set('cart', $cart);

        // Message de confirmation en fiche produit si c'est un appel AJAX
        if ($request->isXmlHttpRequest()) {
            return new Response('Produit ajouté au panier', 200);
        }

        // Sinon on redirige vers le panier
        return $this->redirectToRoute('cart_show');
    }

    #[Route('/cart/remove/{id}/{size}', name: 'cart_remove', methods: ['POST'])]
    public function removeFromCart(Product $product, string $size, SessionInterface $session): Response
    {
        // Récupérer le panier depuis la session
        $cart = $session->get('cart', []);

        // Création d'une clé spécifique avec l'id du produit + sa taille 
        $productKey = $product->getId() . '_' . $size;

        // Vérifier si le produit est dans le panier et le supprimer
        if (isset($cart[$productKey])) {
            unset($cart[$productKey]);
        }

        // Sauvegarder le panier mis à jour dans la session
        $session->set('cart', $cart);

        // Rediriger vers la page du panier après suppression
        return $this->redirectToRoute('cart_show');
    }

}
?>