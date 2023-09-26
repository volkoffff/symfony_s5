<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class MovieFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1,40) as $i) {
            $movie = new Movie();
            $movie -> setTitle('Movie' .$i);
            $movie -> setReleaseDate(new \DateTime());
            $movie -> setDescription('desctiption' . $i);
            $movie -> setDuration(rand(60, 100));
            $movie -> setCategory($this->getReference('category_' . rand(1,10)));
                $movie -> addActor($this -> getReference('actor_' . rand(1, 10)));
                $movie -> addActor($this -> getReference('actor_' . rand(1, 10)));
                $movie -> addActor($this -> getReference('actor_' . rand(1, 10)));
                $movie -> addActor($this -> getReference('actor_' . rand(1, 10)));

            $manager -> persist($movie);

            }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ActorFixture::class
        ];
    }
}
