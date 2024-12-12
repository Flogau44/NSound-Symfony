<?php

namespace App\DataFixtures;

use App\Entity\Schedules;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class SchedulesFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $schedules = ['16h00-17h30', '17h00-18h00', '17h30-19h00', '20h30-22h00', '23h30-01h00', '19h00-20h30', '22h00-23h30', '21h00-22h00', '23h00-01h00', '19h00-20h00'];

        foreach ($schedules as $schedule) {
            $newSchedule = new Schedules();
            $newSchedule->setSchedule($schedule);

            $slug = strtolower($this->slugger->slug($newSchedule->getSchedule()));

            $newSchedule->setSlug($slug);

            $manager->persist($newSchedule);
        }

        $manager->flush();
    }
}
