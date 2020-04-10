<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use Doctrine\Persistence\ObjectManager;

class Ct404CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates 5 categories
        $this->createMany(Ct404Category::class, 5, function (Ct404Category $category) {
            $category->setName($this->faker->unique()->word);
        });

        // Fills the database with the persisted category and subCategory
        $manager->flush();
    }
}
