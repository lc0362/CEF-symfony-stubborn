<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Stock;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackOfficeController extends AbstractController
{
    #[Route('/back-office', name: 'back_office')]
    public function index(
        ProductRepository $productRepository,
        StockRepository $stockRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        // Accès réservé aux admins
        $user = $this->getUser();
        if (!$user || !$user->isAdmin()) {
            return $this->render('back_office/access_denied.html.twig');
        }
       
        // Ajout produit si POST
        if ($request->isMethod('POST')) {
            $product = new Product();
            $product->setName($request->request->get('name'));
            $product->setPrice($request->request->get('price'));
            $product->setTop($request->request->get('top', 0));
        
            // 🔥 Gestion de l'image uploadée
            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getParameter('uploads_dir'), $newFilename);
                $product->setImg('uploads/' . $newFilename);
            } else {
                // Image par défaut si pas d'upload
                $product->setImg('uploads/default.jpg');
            }
        
            $entityManager->persist($product);
            $entityManager->flush();
        
            // Ajout des stocks
            $sizes = ['XS', 'S', 'M', 'L', 'XL'];
            foreach ($sizes as $size) {
                $stock = new Stock();
                $stock->setProduct($product);
                $stock->setSize(SizeEnum::from($size));
                $stock->setQuantity($request->request->get('stock_' . $size, 0));
                $entityManager->persist($stock);
            }
        
            $entityManager->flush();
        
            return $this->redirectToRoute('back_office');
        }
        

        // Liste des produits
        $products = $productRepository->findAll();

        return $this->render('back_office/index.html.twig', [
            'products' => $products,
            'stocks' => $stockRepository->findAll(),
        ]);
    }
    #[Route('/back-office/delete/{id}', name: 'delete_product')]
    public function deleteProduct(Product $product, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('back_office');
    }

}
