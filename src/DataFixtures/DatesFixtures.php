<?php

namespace App\DataFixtures;

use App\Entity\Dates;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class DatesFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des dates à ajouter
        $dates = ['11/07/2025', '12/07/2025', '13/07/2025'];
        foreach ($dates as $date) {
            $newDate = new Dates();
            // Conversion de la date au format DateTime
            $newDate->setDate(\DateTime::createFromFormat('d/m/Y', $date));
            // Génération du slug à partir de la date
            $slug = strtolower($this->slugger->slug($newDate->getDate()->format('d-m-Y'))->toString());
            $newDate->setSlug($slug);
            // Persistance de l'entité
            $manager->persist($newDate);
        }
        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
