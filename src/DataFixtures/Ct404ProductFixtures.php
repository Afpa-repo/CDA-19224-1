<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use App\Entity\Ct404Product;
use App\Entity\Ct404Supplier;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404ProductFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404CategoryFixtures::class,
            Ct404SupplierFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates between 10 and 20 products
        $this->createMany(Ct404Product::class, mt_rand(10, 20), function (Ct404Product $product) {
            // Fills the newly created Product
            $product
                ->setProductName($this->faker->unique()->word)
                ->setDescription($this->faker->realText())
                ->setPrice($this->faker->randomFloat(2, 1, 10000))
                ->setQuantityStock($this->faker->numberBetween(0, 10000))
                ->setQuantityOfAlert($this->faker->numberBetween(0, 1000))
                ->setIdCt404Category($this->getRandomReference(Ct404Category::class))
                ->setIdCt404Supplier($this->getRandomReference(Ct404Supplier::class))
            ;
        });

        // Fills the database with the persisted supplier
        $manager->flush();
    }
}
