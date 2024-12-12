<?php

namespace App\DataFixtures;

use App\Entity\Schedules;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class SchedulesFixtures extends Fixture
{
    // Injection du service SluggerInterface
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Liste des horaires à ajouter
        $schedules = ['16h00-17h30', '17h00-18h00', '17h30-19h00', '20h30-22h00', '23h30-01h00', '19h00-20h30', '22h00-23h30', '21h00-22h00', '23h00-01h00', '19h00-20h00'];

        foreach ($schedules as $schedule) {
            $newSchedule = new Schedules();
            // Définir l'horaire
            $newSchedule->setSchedule($schedule);

            // Génération du slug à partir de l'horaire
            $slug = strtolower($this->slugger->slug($newSchedule->getSchedule()));

            $newSchedule->setSlug($slug);

            // Persistance de l'entité
            $manager->persist($newSchedule);
        }

        // Enregistrement des entités en base de données
        $manager->flush();
    }
}
