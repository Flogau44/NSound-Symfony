<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions->disable(Action::NEW); // Désactive l'action "Créer User"
}


    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour le mot de passe de l'utilisateur
            TextField::new('name'),
            // Champ pour l'email de l'utilisateur
            EmailField::new('email'),
            // Champ pour le mot de passe de l'utilisateur
            TextField::new('password'),
            // Champ pour le role user
            ArrayField::new('roles')
        ];
    }
}
