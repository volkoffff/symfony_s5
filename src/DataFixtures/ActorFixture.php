<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class ActorFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $firstName = ['Jean', 'Pierre', 'Paul', 'Jacques', 'Marie', 'Julie', 'Julien', 'Jeanne', 'Pierre', 'Paul'];
        $lastName = ['Dupont', 'Durand', 'Martin', 'Bernard', 'Dubois', 'Thomas', 'Robert', 'Richard', 'Petit', 'Durand'];

        foreach (range(1, 10) as $i) {
            $actor = new Actor();
            $actor->setFirstName($firstName[rand(0, 9)]);
            $actor->setLastName($lastName[rand(0, 9)]);


            $actor->SetNationalite($this->getReference('nationalite_' .rand(1, 10)));

            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor); // expose l'objet à l'extérieur de la classe pour les liaisons avec Movie
        }

        $manager->flush();
    }
public function getDependencies()
{
    return [
      NationaliteFixture::class
    ];
}
}
