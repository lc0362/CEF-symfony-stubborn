<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products_list')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }
    #[Route('/product/{id}', name: 'product_id')]
public function show(Product $product): Response
{
    return $this->render('product/index.html.twig', [
        'product' => $product,
    ]);
}

}