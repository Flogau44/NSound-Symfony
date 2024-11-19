<?php

namespace App\Controller\Admin;

use App\Entity\ConcertDetails;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ConcertDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConcertDetails::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('artist'),
            AssociationField::new('date'),
            AssociationField::new('scene'),
            AssociationField::new('schedule'),
            DateField::new('created_at'),
        ];
    }

}
