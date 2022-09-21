<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $faker = Factory::create();
            $category->setTitle($faker->name);
            $category->setDescription($faker->name);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
