<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // admin
        $admin = new User();
        $admin->setName('admin');
        $admin->setEmail('admin123@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsVerified(true);
        $admin->setAddress('8 rue du bac 54100 Nancy');
        $admin->setPassword($this->hasher->hashPassword($admin, 'adminpass'));
        $manager->persist($admin);

        // clients
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setName($faker->userName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_CUSTOMER']);
            $user->setIsVerified(true);
            $user->setAddress($faker->address());
            $user->setPassword($this->hasher->hashPassword($user, 'customerpass'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
?>