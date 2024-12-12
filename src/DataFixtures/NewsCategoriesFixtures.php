<?php

namespace App\DataFixtures;

use App\Entity\NewsCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewsCategoriesFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des catégories de news à ajouter
        $newsCategories = ['Sécurité', 'Urgente', 'Générale', 'Actualité'];

        foreach ($newsCategories as $newsCategorie) {
            $newNewsCategorie = new NewsCategories();
            // Définir le type de news
            $newNewsCategorie->setType($newsCategorie);

            // Génération du slug à partir du type de news
            $slug = strtolower($this->slugger->slug($newNewsCategorie->getType()));
            $newNewsCategorie->setSlug($slug);

            // Définir la gravité à 0
            $newNewsCategorie->setGravity('0');

            // Persistance de l'entité
            $manager->persist($newNewsCategorie);
        }

        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
