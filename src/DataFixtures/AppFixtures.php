<?php

namespace App\DataFixtures;

use App\Entity\Stock;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $products = $manager->getRepository(Product::class)->findAll();
        $sizes = ['XS', 'S', 'M', 'L', 'XL'];

        foreach ($products as $product) {
            foreach ($sizes as $size) {
                $stock = new Stock();
                $stock->setProduct($product);
                $stock->setSize($size);
                $stock->setQuantity($faker->numberBetween(1, 30));
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


namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
?>