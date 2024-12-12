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
            // Champ pour le type de catégorie de partenaire
            TextField::new('type'),
            // Champ pour le slug, basé sur le type de catégorie
            SlugField::new('slug')->setTargetFieldName('type'),
        ];
    }
}
