<?php

namespace App\DataFixtures;

use App\Entity\Ct404User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Ct404UserFixtures extends BaseFixture
{
    /* @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        // Creates 10 users
        $this->createMany(Ct404User::class, 10, function (Ct404User $user) {
            $user
                ->setEmail($this->faker->unique()->email)
                ->setPassword($this->passwordEncoder->encodePassword($user, 'filrouge'))
                ->setUserToken((new DateTime())->getTimestamp())
                ->setRolesValid()
            ;
        });

        // Fills the database with the persisted user
        $manager->flush();
    }
}
