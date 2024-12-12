<?php

namespace App\Controller\Admin;

use App\Entity\Scenes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ScenesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Scenes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour le nom de la scène
            TextField::new('name'),
            // Champ pour le slug, basé sur le nom de la scène
            SlugField::new('slug')->setTargetFieldName('name'),
        ];
    }
}
