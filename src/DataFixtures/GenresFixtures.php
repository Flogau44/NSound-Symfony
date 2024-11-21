<?php

namespace App\DataFixtures;

use App\Entity\Genres;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class GenresFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $genres = ['Rock', 'Electro', 'R&B', 'Metal', 'House'];

        foreach ($genres as $genre) {
            $newGenre = new Genres();
            $newGenre->setGenre($genre);

            $slug = strtolower($this->slugger->slug($newGenre->getGenre()));

            $newGenre->setSlug($slug);

            $manager->persist($newGenre);
        }

        $manager->flush();
    }
}
