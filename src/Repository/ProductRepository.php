<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function insertProducts(): void
    {
        $entityManager = $this->getEntityManager();
    
        $products = [
            ["Blackbelt", 29.90, "uploads/1.jpeg", true],
            ["BlueBelt", 29.90, "uploads/2.jpeg", false],
            ["Street", 34.50, "uploads/3.jpeg", false],
            ["Pokeball", 45.00, "uploads/4.jpeg", true],
            ["PinkLady", 29.90, "uploads/5.jpeg", false],
            ["Snow", 32.00, "uploads/6.jpeg", false],
            ["Greyback", 28.50, "uploads/7.jpeg", false],
            ["BlueCloud", 45.00, "uploads/8.jpeg", false],
            ["BornInUsa", 59.90, "uploads/9.jpeg", true],
            ["GreenSchool", 42.20, "uploads/10.jpeg", false]
        ];
    
        foreach ($products as [$name, $price, $img, $top]) {
            // Vérifier si le produit existe déjà
            $existingProduct = $this->findOneBy(['name' => $name]);
    
            if (!$existingProduct) {
                $product = new Product();
                $product->setName($name);
                $product->setPrice($price);
                $product->setImg($img);
                $product->setTop($top);
    
                $entityManager->persist($product);
            }
        }
    
        $entityManager->flush();
    }
    
}
