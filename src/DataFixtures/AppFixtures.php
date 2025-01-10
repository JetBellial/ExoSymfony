<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1 = new Utilisateur();
        $user1
            ->setEmail("test@test.fr")
            ->setFirstname("Thomas")
            ->setLastname("Bebou")
            ->setPassword("12345");

        $manager->flush();
    }
}
