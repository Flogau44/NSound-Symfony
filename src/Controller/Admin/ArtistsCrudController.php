<?php

namespace App\Controller\Admin;

use App\Entity\Artists;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
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
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),
            AssociationField::new('genres'),
            TextEditorField::new('content'),
            ImageField::new('picture')->setBasePath('build/images/')->setUploadDir('public/build/images/')->setUploadedFileNamePattern('[randomhash].[extension]')->setRequired(false),
            UrlField::new('url'),
            TextareaField::new('video')->renderAsHtml(),
            DateField::new('created_at'),
        ];
    }

}
