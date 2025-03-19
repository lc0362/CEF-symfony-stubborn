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
use App\Enum\SizeEnum;

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

        $imageMessage = ''; // ✅ Toujours initialiser

        // Ajout produit si POST
        if ($request->isMethod('POST')) {
            $product = new Product();
            $product->setName($request->request->get('name'));
            $product->setPrice($request->request->get('price'));
            $product->setTop($request->request->get('top', 0));

            // Gestion de l'image
            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $maxSize = 2 * 1024 * 1024 * 1024; // 2 Go
                $extension = strtolower($imageFile->getClientOriginalExtension());

                if ($extension !== 'jpg' || $imageFile->getSize() > $maxSize) {
                    $imageMessage = 'Chargez une image jpg de moins de 2Go';
                } else {
                    $imageFileName = uniqid() . '.' . $imageFile->guessExtension();
                    $imageFile->move($this->getParameter('uploads_dir'), $imageFileName);
                    $product->setImg('uploads/' . $imageFileName);
                    $imageMessage = 'Image chargée';
                }
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
            'imageMessage' => $imageMessage
        ]);
    }

    #[Route('/back-office/update/{id}', name: 'update_product', methods: ['POST'])]
    public function updateProduct(
        Request $request, 
        ProductRepository $productRepository, 
        EntityManagerInterface $entityManager, 
        $id
    ): Response {
        $product = $productRepository->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $product->setName($request->request->get('name'));
        $product->setPrice($request->request->get('price'));

        foreach ($product->getStocks() as $stock) {
            $sizeKey = 'stock_' . $stock->getSize()->value;
            $quantity = $request->request->get($sizeKey);
            if ($quantity !== null) {
                $stock->setQuantity((int)$quantity);
            }
        }

        $entityManager->flush();

        return $this->redirectToRoute('back_office');
    }

    #[Route('/back-office/delete/{id}', name: 'delete_product')]
    public function deleteProduct(Product $product, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('back_office');
    }
}
