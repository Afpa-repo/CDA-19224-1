<?php

namespace App\DataFixtures;

use App\Entity\Ct404Product;
use App\Entity\Ct404SubCategory;
use App\Entity\Ct404Supplier;
use App\Repository\Ct404CategoryRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404ProductFixtures extends BaseFixture implements DependentFixtureInterface
{
    /* @var Ct404CategoryRepository */
    private $categoryRepository;

    public function __construct(Ct404CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404SubCategoryFixtures::class,
            Ct404SupplierFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates between 10 and 20 products
        $this->createMany(Ct404Product::class, mt_rand(10, 20), function (Ct404Product $product) {
            // Fills the newly created Product
            $product
                ->setName($this->faker->unique()->word)
                ->setDescription($this->faker->realText())
                ->setPrice($this->faker->randomFloat(2, 1, 10000000))
                ->setStockQuantity($this->faker->numberBetween(1, 999999))
                ->setAlertQuantity($this->faker->numberBetween(1, 1000))
                ->setSubCategory($this->getRandomReference(Ct404SubCategory::class))
                ->setSupplier($this->getRandomReference(Ct404Supplier::class))
            ;
        });

        // Fills the database with the persisted supplier
        $manager->flush();
    }
}
