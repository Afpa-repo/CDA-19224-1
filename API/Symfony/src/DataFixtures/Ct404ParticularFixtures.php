<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Particular;
use App\Entity\Ct404User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404ParticularFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404CommercialFixtures::class,
            Ct404UserFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates 5 particulars
        $this->createMany(Ct404Particular::class, 5, function (Ct404Particular $particular) {
            // Fills the newly created Particular
            $particular
                ->setAddress($this->faker->unique()->address)
                ->setCommercial($this->getRandomReference(Ct404Commercial::class))
                ->setLastname($this->faker->unique()->lastName)
                ->setFirstname($this->faker->unique()->firstName)
                ->setCity($this->faker->unique()->city)
                ->setPhoneNumber($this->faker->unique()->phoneNumber)
                ->setPseudo($this->faker->unique()->userName)
                ->setZipCode((int) $this->faker->unique()->postcode)
            ;

            for ($i = 0; $i < 5; ++$i) {
                $particular->setUser($this->getReference(Ct404User::class.'_'.$i));
            }
        });

        // Fills the database with the persisted particular
        $manager->flush();
    }
}
