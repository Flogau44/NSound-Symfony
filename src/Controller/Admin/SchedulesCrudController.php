<?php

namespace App\Controller\Admin;

use App\Entity\Schedules;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SchedulesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Schedules::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour l'horaire
            TextField::new('schedule'),
            // Champ pour le slug, basé sur l'horaire
            SlugField::new('slug')->setTargetFieldName('schedule'),
        ];
    }
}
