<?php

namespace App\DataFixtures;

use App\Entity\Ct404Commercial;
use App\Entity\Ct404Particular;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Ct404ParticularFixtures extends BaseFixture implements DependentFixtureInterface
{
    /* @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            Ct404CommercialFixtures::class,
        ];
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates between 3 and 5 particulars
        $this->createMany(Ct404Particular::class, mt_rand(3, 5), function (Ct404Particular $particular) {
            // Fills the newly created Particular
            $particular
                ->setAddress($this->faker->address)
                ->setCommercial($this->getRandomReference(Ct404Commercial::class))
                ->setLastname($this->faker->lastName)
                ->setFirstname($this->faker->firstName)
                // Don't do this at home kids !!!!!!
                // This is just temporary since I don't have the classes that implements the UserInterface yet
                // So I can't use the UserPasswordEncoder yet
                ->setCity($this->faker->city)
                ->setPhoneNumber($this->faker->phoneNumber)
                ->setPseudo($this->faker->userName)
                ->setZipCode((int) $this->faker->postcode)
            ;
        });

        // Fills the database with the persisted particular
        $manager->flush();
    }
}
