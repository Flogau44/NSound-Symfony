<?php

namespace App\DataFixtures;

use App\Entity\Scenes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class ScenesFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $scenes = ['Mainstage 1', 'Mainstage 2', 'Sonata', 'Resonance', 'Reverb'];

        foreach ($scenes as $scene) {
            $newScene = new Scenes();
            $newScene->setName($scene);

            $slug = strtolower($this->slugger->slug($newScene->getName()));

            $newScene->setSlug($slug);

            $manager->persist($newScene);
        }

        $manager->flush();
    }
}
