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
                ->setSupplierAddress($this->faker->address)
                ->setSupplierCity($this->faker->city)
                ->setSupplierMail($this->faker->unique()->companyEmail)
                ->setSupplierName($this->faker->unique()->company)
                ->setSupplierPhone($this->faker->unique()->serviceNumber)
                ->setSupplierZipCode((int) $this->faker->postcode)
            ;
        });

        // Fills the database with the persisted supplier
        $manager->flush();
    }
}
