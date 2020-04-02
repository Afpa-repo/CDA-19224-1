<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use Doctrine\Persistence\ObjectManager;

class Ct404CommercialFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates between 3 and 6 commercials
        $this->createMany(Ct404Commercial::class, mt_rand(3, 6), function (Ct404Commercial $commercial) {
            // Fills the newly created Commercial
            $commercial
                ->setCommercialForIndividual($this->faker->boolean)
                ->setCommercialForProfessional($this->faker->boolean)
                ->setFirstname($this->faker->unique()->firstName)
                ->setLastname($this->faker->unique()->lastName)
            ;
        });

        // Fills the database with the persisted commercial
        $manager->flush();
    }
}