<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_app')]
    public function index(): Response
    {
        // Rend la vue 'index.html.twig' avec le nom du contrôleur
        return $this->render('index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}
