<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminSecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auth_admin');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button[type="submit"]', 'Se connecter');
    }

    public function testLogout()
    {
        $client = static::createClient();
        $client->request('GET', '/admin/logout');

        $this->assertResponseRedirects('/auth_admin');
    }
}
