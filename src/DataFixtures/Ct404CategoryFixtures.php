<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class Ct404CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Creates a french instance of Faker
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < mt_rand(3, 6); ++$i) {
            // Creates and fills the newly created Category
            $category = new Ct404Category();
            $category->setCategoryName($faker->word);
            // Persists the category
            $manager->persist($category);
        }

        // Fills the database with the persisted category
        $manager->flush();
    }
}
