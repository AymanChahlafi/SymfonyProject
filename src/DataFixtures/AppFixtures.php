<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $faker = Factory::create();
            $product
                ->setName($faker->sentence())
                ->setDescription($faker->text(350))
                ->setPrice(mt_rand(10, 600))
                ->setImage("https://dummyimage.com/450x300/dee2e6/6c757d.jpg");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
