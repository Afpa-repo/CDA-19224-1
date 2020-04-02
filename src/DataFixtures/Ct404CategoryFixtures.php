<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use App\Entity\Ct404SubCategory;
use Doctrine\Persistence\ObjectManager;

class Ct404CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates between 4 and 8 categories
        $this->createMany(Ct404Category::class, mt_rand(4, 8), function (Ct404Category $category) use ($manager) {
            $category->setName($this->faker->unique()->word);

            // All categories might not have one or multiple sub categories
            if ($this->faker->boolean) {
                for ($i = 0; $i < mt_rand(0, 3); ++$i) {
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
