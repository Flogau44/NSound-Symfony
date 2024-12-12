<?php

namespace App\DataFixtures;

use App\Entity\NewsCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewsCategoriesFixtures extends Fixture
{
    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $newsCategories = ['Sécurité', 'Urgente', 'Générale', 'Actualité'];

        foreach ($newsCategories as $newsCategorie) {
            $newNewsCategorie = new NewsCategories();
            $newNewsCategorie->setType($newsCategorie);

            $slug = strtolower($this->slugger->slug($newNewsCategorie->getType()));
            $newNewsCategorie->setSlug($slug);

            // Set gravity to 0
            $newNewsCategorie->setGravity('0');

            $manager->persist($newNewsCategorie);
        }

        $manager->flush();
    }
}
