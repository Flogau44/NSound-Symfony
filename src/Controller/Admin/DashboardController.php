<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\Alerts;
use App\Entity\AlertType;
use App\Entity\PartnerCategories;
use App\Entity\Partners;
use App\Entity\Artists;
use App\Entity\ConcertDetails;
use App\Entity\Dates;
use App\Entity\Scenes;
use App\Entity\Schedules;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(NewsCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Nation Sound');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('News', 'fas fa-list', News::class);
        yield MenuItem::linkToCrud('Alertes', 'fas fa-list', Alerts::class);
        yield MenuItem::linkToCrud('Types des alertes', 'fas fa-list', AlertType::class);
        yield MenuItem::linkToCrud('Categories des partenaires', 'fas fa-list', PartnerCategories::class);
        yield MenuItem::linkToCrud('Partenaires', 'fas fa-list', Partners::class);
        yield MenuItem::linkToCrud('Dates', 'fas fa-list', Dates::class);
        yield MenuItem::linkToCrud('Artistes', 'fas fa-list', Artists::class);
        yield MenuItem::linkToCrud('Détail des concerts', 'fas fa-list', ConcertDetails::class);
        yield MenuItem::linkToCrud('Scènes', 'fas fa-list', Scenes::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-list', Schedules::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);

    }
}
