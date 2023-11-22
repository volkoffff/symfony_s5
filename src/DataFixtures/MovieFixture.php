<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MovieFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 40) as $i) {
            $movie = new Movie();
            $movie -> setTitle('Movie' . $i);
            $movie -> setReleaseDate(new \DateTime());
            $movie -> setDescription('Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, ' . $i);
            $movie -> setDuration(rand(60, 100));
            $movie -> setCategory($this->getReference('category_' . rand(1, 10)));
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
