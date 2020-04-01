<?php

namespace App\DataFixtures;

use App\Entity\Ct404OrderDetail;
use App\Entity\Ct404Ordered;
use App\Entity\Ct404Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404OrderDetailFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404OrderedFixtures::class,
            Ct404ProductFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates between 10 order detail
        $this->createMany(Ct404OrderDetail::class, 10, function (Ct404OrderDetail $orderDetails) {
            // Fills the newly created order detail
            $orderDetails
                ->setIdOrder($this->getRandomReference(Ct404Ordered::class))
                ->setIdProduct($this->getRandomReference(Ct404Product::class))
                ->setQuantity($this->faker->numberBetween(1, 10000))
           ;
        });

        // Fills the database with the persisted order detail
        $manager->flush();
    }
}
