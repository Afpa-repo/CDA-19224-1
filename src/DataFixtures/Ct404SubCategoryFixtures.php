<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use App\Entity\Ct404SubCategory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Ct404SubCategoryFixtures extends BaseFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404CategoryFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates 10 sub categories
        $this->createMany(Ct404SubCategory::class, 10, function (Ct404SubCategory $subCategory) {
            $subCategory
                ->setName($this->faker->unique()->word)
                ->setCategory($this->getRandomReference(Ct404Category::class))
            ;
        });

        // Fills the database with the persisted sub category
        $manager->flush();
    }
}
