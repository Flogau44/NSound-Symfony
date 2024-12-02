<?php

namespace App\Controller\Admin;

use App\Entity\NewsCategories;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewsCategories::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('type'),
            SlugField::new('slug')->setTargetFieldName('type'),
            TextField::new('gravity'),
        ];
    }
}
