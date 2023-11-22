<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 11; $i++) {
            $category = new Category();
            $category ->setName('catergory' . $i);
            $manager->persist($category);

            $this->addReference('category_' . $i, $category);
            // peremet que la catégorie soit dispo dans les autres fixture
        }


        $manager->flush();
    }
}
