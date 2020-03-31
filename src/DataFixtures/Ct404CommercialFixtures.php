<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class Ct404CommercialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Creates a french instance of Faker
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i < mt_rand(3, 6); ++$i) {
            // Creates and fills the newly created Commercial
            $commercial = new Ct404Commercial();
            $commercial
                ->setCommercialForIndividual($faker->boolean)
                ->setCommercialForProfessional($faker->boolean)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
            ;
            // Persists the category
            $manager->persist($commercial);
        }

        // Fills the database with the persisted commercial
        $manager->flush();
    }
}
