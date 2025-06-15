<?php

namespace App\DataFixtures;

use App\Entity\Genres;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class GenresFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des genres à ajouter
        $genres = ['Rock', 'Electro', 'R&B', 'Metal', 'House', 'Rap','Folk','Blues','Pop', 'Jazz', 'Reggae'];

        foreach ($genres as $genre) {
            $newGenre = new Genres();
            // Définir le genre
            $newGenre->setGenre($genre);

            // Génération du slug à partir du genre
            $slug = strtolower($this->slugger->slug($newGenre->getGenre()));

            $newGenre->setSlug($slug);

            // Persistance de l'entité
            $manager->persist($newGenre);
        }

        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
