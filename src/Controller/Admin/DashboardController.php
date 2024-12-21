<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\User;
use App\Entity\Dates;
use App\Entity\Genres;
use App\Entity\Scenes;
use App\Entity\Artists;
use App\Entity\Partners;
use App\Entity\Schedules;
use App\Entity\ConcertDetails;
use App\Entity\Markers;
use App\Entity\NewsCategories;
use App\Entity\PartnerCategories;
use App\Entity\Polygons;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirige vers le contrôleur NewsCrudController par défaut
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(NewsCrudController::class)->generateUrl());

        // Option 2. Redirige vers différentes pages selon l'utilisateur
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. Affiche un tableau de bord personnalisé avec des widgets, etc.
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Nation Sound');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Informations');
        yield MenuItem::linkToCrud('News', 'fa-solid fa-newspaper', News::class);
        yield MenuItem::linkToCrud('Type de news', 'fa-solid fa-list', NewsCategories::class);

        yield MenuItem::section('Partenaires');
        yield MenuItem::linkToCrud('Partenaires', 'fa-regular fa-handshake', Partners::class);
        yield MenuItem::linkToCrud('Catégories des partenaires', 'fa-solid fa-list', PartnerCategories::class);

        yield MenuItem::section('Concerts');
        yield MenuItem::linkToCrud('Détail des concerts', 'fas fa-list', ConcertDetails::class);
        yield MenuItem::linkToCrud('Artistes', 'fa-solid fa-guitar', Artists::class);
        yield MenuItem::linkToCrud('Genres', 'fa-solid fa-music', Genres::class);
        yield MenuItem::linkToCrud('Scènes', 'fa-solid fa-sliders', Scenes::class);
        yield MenuItem::linkToCrud('Dates', 'fa-solid fa-calendar-days', Dates::class);
        yield MenuItem::linkToCrud('Horaires', 'fa-regular fa-clock', Schedules::class);

        yield MenuItem::section('Map');
        yield MenuItem::linkToCrud('Markers', 'fa-solid fa-location-dot', Markers::class);
        yield MenuItem::linkToCrud('Polygons', 'fa-solid fa-draw-polygon', Polygons::class);

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class);
    }
}
