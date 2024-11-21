<?php

namespace App\DataFixtures;

use App\Entity\PartnerCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class PartnerCategoriesFixtures extends Fixture
{

    public function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void

    {
        $partnerCategories = ['Partenaire Officiel', 'Partenaire Média'];

        foreach ($partnerCategories as $partnerCategorie) {
            $newPartnerCategorie = new PartnerCategories();
            $newPartnerCategorie->setType($partnerCategorie);

            $slug = strtolower($this->slugger->slug($newPartnerCategorie->getType()));

            $newPartnerCategorie->setSlug($slug);

            $manager->persist($newPartnerCategorie);
        }

        $manager->flush();
    }
}
