<?php

namespace App\Controller\Admin;

use App\Entity\Alerts;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlertsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alerts::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            SlugField::new('slug')->setTargetFieldName('title'),
            AssociationField::new('type'),
            TextEditorField::new('content'),
            DateField::new('created_at'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('type');
    }
}
