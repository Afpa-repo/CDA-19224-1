<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Professional;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404ProfessionalFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404CommercialFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates between 3 and 5 professionals
        $this->createMany(Ct404Professional::class, mt_rand(3, 5), function (Ct404Professional $professional) {
            // Fills the newly created Professional
            $professional
                ->setUserKey(bin2hex(random_bytes(16)))
                ->setEmail($this->faker->companyEmail)
                ->setActive($this->faker->boolean)
                // Don't do this at home kids !!!!!!
                // This is just temporary since I don't have the classes that implements the UserInterface yet
                // So I can't use the UserPasswordEncoder yet
                ->setPassword(md5('filrouge'))
                ->setCommercial($this->getRandomReference(Ct404Commercial::class))
                ->setCompany($this->faker->company)
                ->setSiret($this->faker->siret)
                ->setContact($this->faker->name)
            ;
        });

        // Fills the database with the persisted professional
        $manager->flush();
    }
}
