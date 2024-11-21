<?php

namespace App\DataFixtures;

use App\Entity\Dates;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class DatesFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $dates = ['11/07/2025', '12/07/2025', '13/07/2025'];
        foreach ($dates as $date) {
            $newDate = new Dates();
            $newDate->setDate(\DateTime::createFromFormat('d/m/Y', $date));
            $slug = strtolower($this->slugger->slug($newDate->getDate()->format('d-m-Y'))->toString());
            $newDate->setSlug($slug);
            $manager->persist($newDate);
        }
        $manager->flush();
    }
}
