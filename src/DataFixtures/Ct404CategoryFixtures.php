<?php

namespace App\DataFixtures;

use App\Entity\Ct404Category;
use Doctrine\Persistence\ObjectManager;

class Ct404CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates between 3 and 6 categories
        $this->createMany(Ct404Category::class, mt_rand(3, 6), function (Ct404Category $category) {
            $category->setCategoryName($this->faker->word);
        });

        // Fills the database with the persisted category
        $manager->flush();
    }
}
