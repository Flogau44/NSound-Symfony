<?php

namespace App\Controller\Admin;

use App\Entity\ConcertDetails;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConcertDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConcertDetails::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour publier ou non le détail du concert
            BooleanField::new('publish'),
            // Champ pour l'association avec l'artiste
            AssociationField::new('artist'),
            // Champ pour l'association avec la date
            AssociationField::new('date'),
            // Champ pour l'association avec la scène
            AssociationField::new('scene'),
            // Champ pour l'association avec l'horaire
            AssociationField::new('schedule'),
            // Champ pour la date de création
            DateField::new('created_at'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('publish')
            ->add('date')
            ->add('scene')
            ->add('schedule');
    }
}
