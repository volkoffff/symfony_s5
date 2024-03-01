<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(protected UserPasswordHasherInterface $passwordHasherInterface)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 5) as $i) {
            $user = new User();
            $user -> setEmail('email' . $i . '@gmail.com');
            $user -> setFirstName('Jhon');
            $user -> setLastName('Doe');
            $user -> setPassword($this->passwordHasherInterface->hashPassword(
                $user,
                'password'
            ));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
