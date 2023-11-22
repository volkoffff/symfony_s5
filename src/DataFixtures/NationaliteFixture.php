<?php

namespace App\DataFixtures;

use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationaliteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 10) as $i) {
            $nationalite = new Nationalite();
            $nationalite -> setNationalite('nationalite' . $i);

            $manager ->persist($nationalite);
            $this->addReference('nationalite_' . $i, $nationalite);
        }

        $manager->flush();
    }
}
