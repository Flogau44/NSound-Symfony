<?php

namespace App\DataFixtures;

use App\Entity\Scenes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class ScenesFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des scènes à ajouter
        $scenes = ['Mainstage 1', 'Mainstage 2', 'Sonata', 'Resonance', 'Reverb'];

        foreach ($scenes as $scene) {
            $newScene = new Scenes();
            // Définir le nom de la scène
            $newScene->setName($scene);

            // Génération du slug à partir du nom de la scène
            $slug = strtolower($this->slugger->slug($newScene->getName()));

            $newScene->setSlug($slug);

            // Persistance de l'entité
            $manager->persist($newScene);
        }

        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
