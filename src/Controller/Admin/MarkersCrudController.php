<?php

namespace App\Controller\Admin;

use App\Entity\Markers;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

// Déclare une nouvelle classe qui étend AbstractCrudController pour bénéficier de ses fonctionnalités
class MarkersCrudController extends AbstractCrudController
{
    // Définit la méthode getEntityFqcn qui retourne la classe de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        // Retourne le FQCN (Fully Qualified Class Name) de l'entité Markers
        return Markers::class;
    }

    // Configure les champs affichés sur les différentes pages (index, edit, etc.)
    public function configureFields(string $pageName): iterable
    {
        // Retourne une liste de champs à afficher/éditer dans l'interface d'administration
        return [
            // Champ de texte pour le titre du marker
            TextField::new("title"),

            // Champ numérique pour la longitude du marker
            NumberField::new('longitude'),

            // Champ numérique pour la latitude du marker
            NumberField::new('latitude'),

            // Champ de texte pour le popup associé au marker
            TextField::new('popup'),

            // Champ d'image pour l'icône du marker
            ImageField::new('icon_url')
                // Définit le chemin de base pour accéder aux images
                ->setBasePath('build/images/')
                // Définit le répertoire de téléchargement des images
                ->setUploadDir('public/build/images/')
                // Définit le modèle de nommage des fichiers téléchargés
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                // Indique que ce champ est facultatif
                ->setRequired(false),
        ];
    }
}
