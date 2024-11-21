<?php

namespace App\DataFixtures;

use App\Entity\AlertType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AlertTypeFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $alertTypes = ['Sécurité', 'Urgente'];

        foreach ($alertTypes as $alertType) {
            $newAlertType = new AlertType();
            $newAlertType->setType($alertType);

            $slug = strtolower($this->slugger->slug($newAlertType->getType()));

            $newAlertType->setSlug($slug);

            $manager->persist($newAlertType);
        }

        $manager->flush();
    }
}
