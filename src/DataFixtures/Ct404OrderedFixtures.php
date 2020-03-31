<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Ordered;
use DateTime;
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
        $this->createMany(Ct404Ordered::class, mt_rand(5, 10), function (Ct404Ordered $ordered) {
            // Creates a random date between now and 30 days ago
            $orderDate = $this->faker->dateTimeBetween('-30 days');
            // Gives the remaining days before the delivery date
            $days = (new DateTime())->diff($orderDate)->days;
            // Fills the newly created Ordered
            $ordered
                ->setDeliveryDate($this->faker->dateTimeBetween("-{$days} days"))
                ->setIdCt404Commercial($this->getRandomReference(Ct404Commercial::class))
                ->setOrderDate($orderDate)
                ->setTotalPrice($this->faker->randomFloat(2, 1, 10000))
            ;
        });

        $manager->flush();
    }
}
