<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName($faker->word());
            $product->setPrice($faker->randomFloat(2, 10, 100));
            $product->setImg('uploads/' . ($i + 1) . '.jpeg');
            $product->setTop($faker->boolean());

            $manager->persist($product);
        }

        $manager->flush();
    }
}
?>