<?php

namespace App\Controller\Admin;

use App\Entity\Partners;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PartnersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partners::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour publier ou non le partenaire
            BooleanField::new('publish'),
            // Champ pour le nom du partenaire
            TextField::new('name'),
            // Champ pour le slug, basé sur le nom
            SlugField::new('slug')->setTargetFieldName('name'),
            // Champ pour l'association avec le type de partenaire
            AssociationField::new('type'),
            // Champ pour le logo, avec configuration du chemin de base et du répertoire de téléchargement
            ImageField::new('logo')
                ->setBasePath('build/images/')
                ->setUploadDir('public/build/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            // Champ pour l'URL
            UrlField::new('url'),
            // Champ pour la date de création
            DateField::new('created_at')
                ->setFormTypeOption('disabled', true) // Désactiver le champ
                ->setFormTypeOption('widget', 'single_text')
                ->hideOnForm()
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('publish')
            ->add('type');
    }
}
