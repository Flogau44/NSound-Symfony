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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['created_at' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
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
            TextareaField::new('video')->renderAsHtml(),
            DateField::new('created_at')
                ->setFormTypeOption('disabled', true) // Champ désactivé
                ->setFormTypeOption('widget', 'single_text')
                ->hideOnForm()
        ];

        if ($pageName === Crud::PAGE_INDEX) {
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                TextField::new('genreNames', 'Genres'),
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
