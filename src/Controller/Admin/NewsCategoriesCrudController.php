<?php

namespace App\Controller\Admin;

use App\Entity\NewsCategories;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
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
            // Champ pour le type de news
            TextField::new('type'),
            // Champ pour le slug, basé sur le type de news
            SlugField::new('slug')->setTargetFieldName('type'),
            // Champ pour la gravité de la news
            TextField::new('gravity'),
        ];
    }
}
