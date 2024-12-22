<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour publier ou non la news
            BooleanField::new('publish'),
            // Champ pour le titre de la news
            TextField::new('title'),
            // Champ pour le slug, basé sur le titre
            SlugField::new('slug')->setTargetFieldName('title'),
            // Champ pour l'association avec le type de news
            AssociationField::new('type'),
            // Champ pour le contenu textuel de la news
            TextEditorField::new('content'),
            // Champ pour l'image, avec configuration du chemin de base et du répertoire de téléchargement
            ImageField::new('picture')
                ->setBasePath('build/images/')
                ->setUploadDir('public/build/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            // Champ pour l'URL
            UrlField::new('url'),
            // Champ pour la date de création
            DateField::new('created_at'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('publish');
    }
}
