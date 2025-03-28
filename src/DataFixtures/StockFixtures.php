<?php

namespace App\DataFixtures;

use App\Entity\Stock;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\ProductFixtures;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $stockData = [
            1 => [5, 14, 26, 29, 8],
            2 => [8, 16, 24, 12, 16],
            3 => [15, 24, 14, 28, 8],
            4 => [14, 14, 29, 13, 6],
            5 => [18, 15, 17, 10, 25],
            6 => [8, 19, 15, 16, 2],
            7 => [21, 9, 8, 14, 15],
            8 => [2, 22, 13, 29, 18],
            9 => [30, 7, 30, 11, 24],
            10 => [26, 27, 29, 30, 5],
        ];

        $sizes = ['XS', 'S', 'M', 'L', 'XL'];

        foreach ($stockData as $productId => $quantities) {
            $product = $manager->getRepository(Product::class)->find($productId);

            if (!$product) {
                continue; 
            }

            foreach ($sizes as $index => $size) {
                $stock = new Stock();
                $stock->setProduct($product);
                $stock->setSize($size);
                $stock->setQuantity($quantities[$index]);
                $manager->persist($stock);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProductFixtures::class];
    }
}
