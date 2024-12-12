<?php

namespace App\DataFixtures;

use App\Entity\PartnerCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class PartnerCategoriesFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des catégories de partenaires à ajouter
        $partnerCategories = ['Partenaire Officiel', 'Partenaire Média'];

        foreach ($partnerCategories as $partnerCategorie) {
            $newPartnerCategorie = new PartnerCategories();
            // Définir le type de catégorie de partenaire
            $newPartnerCategorie->setType($partnerCategorie);

            // Génération du slug à partir du type de catégorie
            $slug = strtolower($this->slugger->slug($newPartnerCategorie->getType()));

            $newPartnerCategorie->setSlug($slug);

            // Persistance de l'entité
            $manager->persist($newPartnerCategorie);
        }

        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
