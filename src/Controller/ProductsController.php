<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

final class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products_list')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $filter = $request->query->get('filter');

        if ($filter) {
            [$min, $max] = explode('-', $filter);
            $products = $productRepository->createQueryBuilder('p')
                ->where('p.price BETWEEN :min AND :max')
                ->setParameter('min', $min)
                ->setParameter('max', $max)
                ->getQuery()
                ->getResult();
        } else {
            $products = $productRepository->findAll();
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }


}