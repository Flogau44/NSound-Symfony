<?php

namespace App\Controller\Admin;

use App\Entity\Polygons;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

// Déclare une nouvelle classe qui étend AbstractCrudController pour bénéficier de ses fonctionnalités
class PolygonsCrudController extends AbstractCrudController
{
    // Définit la méthode getEntityFqcn qui retourne la classe de l'entité gérée par ce contrôleur
    public static function getEntityFqcn(): string
    {
        // Retourne le FQCN (Fully Qualified Class Name) de l'entité Polygons
        return Polygons::class;
    }

    // Configure les champs affichés sur les différentes pages (index, edit, etc.)
    public function configureFields(string $pageName): iterable
    {
        // Retourne une liste de champs à afficher/éditer dans l'interface d'administration
        return [
            // Champ de tableau pour les coordonnées des polygones
            ArrayField::new('coordinates'),

            // Champ de texte pour les couleurs associées aux polygones
            TextField::new('colors'),
        ];
    }
}
