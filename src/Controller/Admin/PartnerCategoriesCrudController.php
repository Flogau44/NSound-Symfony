<?php

namespace App\Controller\Admin;

use App\Entity\PartnerCategories;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PartnerCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PartnerCategories::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type'),
            SlugField::new('slug')->setTargetFieldName('type'),
        ];
    }

}
