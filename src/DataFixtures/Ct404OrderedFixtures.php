<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Ordered;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404OrderedFixtures extends BaseFixture implements DependentFixtureInterface
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
        // Creates 10 Ordered
        $this->createMany(Ct404Ordered::class, 10, function (Ct404Ordered $ordered) {
            // Fills the newly created Ordered
            $ordered
                ->setDeliveryDate($this->faker->dateTimeBetween('+1 day', '+14 days'))
                ->setCommercial($this->getRandomReference(Ct404Commercial::class))
                ->setTotalPrice($this->faker->randomFloat(2, 1, 10000000))
            ;
        });

        $manager->flush();
    }
}
