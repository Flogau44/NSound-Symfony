<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    /**
     * Teste si la page d'accueil est accessible.
     */
    public function testHomePageIsAccessible()
    {
        // Crée un client HTTP pour envoyer des requêtes.
        $client = static::createClient();

        // Envoie une requête GET à la page d'accueil ('/').
        $client->request('GET', '/');

        // Vérifie que le statut de la réponse est 200 (OK).
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
