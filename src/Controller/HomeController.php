<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        // Vérifier si l'utilisateur est connecté
        $isConnected = $this->getUser() !== null;

        // Récupérer les produits marqués "top"
        $products = $productRepository->findBy(['top' => true]);

        return $this->render('home/index.html.twig', [
            'isConnected' => $isConnected,
            'products' => $products,
        ]);
    }
}
