<?php

namespace App\Controller\Admin;

use App\Entity\Artists;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtistsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artists::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            // Champ pour le nom de l'artiste
            TextField::new('name'),
            // Champ pour le slug, basé sur le nom
            SlugField::new('slug')->setTargetFieldName('name'),
            // Champ pour l'association avec les genres
            AssociationField::new('genres')
                ->setCrudController(GenresCrudController::class)
                ->autocomplete(),
            // Champ pour le contenu textuel
            TextEditorField::new('content'),
            // Champ pour l'image, avec configuration du chemin de base et du répertoire de téléchargement
            ImageField::new('picture')
                ->setBasePath('build/images/')
                ->setUploadDir('public/build/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            // Champ pour l'URL
            TextareaField::new('url'),
            // Champ pour la vidéo, rendu en HTML
            TextareaField::new('video')->renderAsHtml(),
            // Champ pour la date de création
            DateField::new('created_at'),
        ];

        if ($pageName === Crud::PAGE_INDEX) {
            // Afficher seulement certains champs dans la vue tableau
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                AssociationField::new('genres')
                    ->setCrudController(GenresCrudController::class)
                    ->autocomplete(),
                TextEditorField::new('content'),
                ImageField::new('picture')
                    ->setBasePath('build/images/')
                    ->setUploadDir('public/build/images/')
                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                    ->setRequired(false),
                TextareaField::new('url'),
                DateField::new('created_at'),
            ];
        }

        return $fields;
    }
}
