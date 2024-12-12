<?php

namespace App\Controller\Admin;

use App\Entity\Genres;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GenresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Genres::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour le genre
            TextField::new('genre'),
            // Champ pour le slug, basé sur le genre
            SlugField::new('slug')->setTargetFieldName('genre'),
        ];
    }
}
