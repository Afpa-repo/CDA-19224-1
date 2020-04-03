<?php

namespace App\DataFixtures;

use App\Entity\Ct404Supplier;
use Doctrine\Persistence\ObjectManager;

class Ct404SupplierFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // Creates between 2 and 4 suppliers
        $this->createMany(Ct404Supplier::class, mt_rand(2, 4), function (Ct404Supplier $supplier) {
            // Fills the newly created Supplier
            $supplier
                ->setAddress($this->faker->address)
                ->setCity($this->faker->city)
                ->setEmail($this->faker->unique()->companyEmail)
                ->setName($this->faker->unique()->company)
                ->setPhoneNumber($this->faker->unique()->serviceNumber)
                ->setZipCode((int) $this->faker->postcode)
            ;
        });

        // Fills the database with the persisted supplier
        $manager->flush();
    }
}
