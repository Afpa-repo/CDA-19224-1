<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use App\Entity\Ct404SubCategory;
use Doctrine\Persistence\ObjectManager;

class Ct404CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates 5 categories
        $this->createMany(Ct404Category::class, 5, function (Ct404Category $category) use ($manager) {
            $category->setName($this->faker->unique()->word);

            // All categories might not have one or multiple sub categories
            if ($this->faker->boolean) {
                for ($i = 0; $i < mt_rand(1, 3); ++$i) {
                    $subCategory = new Ct404SubCategory();
                    $subCategory->setName($this->faker->unique()->word);
                    $category->addSubCategory($subCategory);
                    $manager->persist($subCategory);
                }
            }
        });

        // Fills the database with the persisted category and subCategory
        $manager->flush();
    }
}
