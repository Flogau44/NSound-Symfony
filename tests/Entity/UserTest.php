<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    // Test pour vérifier que l'email de l'utilisateur est correctement défini et récupéré
    public function testGetEmail()
    {
        // Crée une nouvelle instance de l'entité User
        $user = new User();
        // Définit l'email de l'utilisateur
        $user->setEmail('test@example.com');

        // Vérifie que l'email défini est correctement récupéré
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    // Test pour vérifier que les rôles de l'utilisateur sont correctement définis et récupérés
    public function testGetRoles()
    {
        // Crée une nouvelle instance de l'entité User
        $user = new User();
        // Définit les rôles de l'utilisateur
        $user->setRoles(['ROLE_ADMIN']);

        // Vérifie que le rôle 'ROLE_ADMIN' est présent dans les rôles de l'utilisateur
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        // Vérifie que le rôle 'ROLE_USER' est également présent (ajouté par défaut)
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    // Test pour vérifier que le mot de passe de l'utilisateur est correctement défini et récupéré
    public function testSetPassword()
    {
        // Crée une nouvelle instance de l'entité User
        $user = new User();
        // Définit le mot de passe de l'utilisateur
        $user->setPassword('password123');

        // Vérifie que le mot de passe défini est correctement récupéré
        $this->assertEquals('password123', $user->getPassword());
    }
}
