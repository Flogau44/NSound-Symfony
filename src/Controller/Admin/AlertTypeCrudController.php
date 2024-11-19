<?php

namespace App\Controller\Admin;

use App\Entity\AlertType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AlertTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AlertType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type'),
            SlugField::new('slug')->setTargetFieldName('type'),
        ];
    }

}
