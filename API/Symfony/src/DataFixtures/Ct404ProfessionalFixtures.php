<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Professional;
use App\Entity\Ct404User;
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
        // Creates 5 professionals
        $this->createMany(Ct404Professional::class, 5, function (Ct404Professional $professional) {
            // Fills the newly created Professional
            $professional
                ->setCommercial($this->getRandomReference(Ct404Commercial::class))
                ->setAddress($this->faker->unique()->address)
                ->setCity($this->faker->unique()->city)
                ->setLastname($this->faker->unique()->lastName)
                ->setFirstname($this->faker->unique()->firstName)
                ->setPhoneNumber($this->faker->unique()->serviceNumber)
                ->setCompany($this->faker->unique()->company)
                ->setSiret($this->faker->unique()->siret)
                ->setZipCode((int) $this->faker->unique()->postcode)
                ->setCompanyEmail($this->faker->unique()->companyEmail)
            ;

            for ($i = 5; $i < 10; ++$i) {
                $professional->setUser($this->getReference(Ct404User::class.'_'.$i));
            }
        });

        // Fills the database with the persisted professional
        $manager->flush();
    }
}
