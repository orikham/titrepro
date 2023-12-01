<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Articles;
use App\Entity\Category;
use App\Entity\SousCategory;
use App\Entity\Pictures;
use App\Entity\InfosContact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
        ){

        }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        

        $url = $this->adminUrlGenerator
        ->setController(ArticlesCrudController::class)
        ->generateUrl();

        return $this->redirect(
            $url
        );







        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

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
            ->setTitle('Titrepro');
    }

    public function configureMenuItems(): iterable
    {   yield MenuItem::section('Tableau de Bord', 'fa fa-dashboard');
            yield MenuItem::subMenu('User', 'fa fa-user');

            yield MenuItem::subMenu('Articles', 'fa fa-')->setSubItems([
                MenuItem::linkToCrud('Ajout d\'articles', 'fas fa-plus', Articles::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des articles', 'fas fa-eye', Articles::class),
                MenuItem::linkToCrud('Modification artciles', 'fas fa-edit', Articles::class)->setAction(Crud::PAGE_EDIT)
            ]);
                

            yield MenuItem::subMenu('Pictures', 'fa fa-')->setSubItems([
                MenuItem::linkToCrud('Ajouts de photos', 'fas fa-plus', Pictures::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des photos', 'fas fa-eye', Pictures::class),
                MenuItem::linkToCrud('Modifier les photos', 'fas fa-edit', Pictures::class)->setAction(Crud::PAGE_EDIT)
            ]);

            yield MenuItem::subMenu('Category', 'fa fa-')->setSubItems([
                MenuItem::linkToCrud('Ajouts de Category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des Category', 'fas fa-eye', Category::class),
                MenuItem::linkToCrud('Modifier les Category', 'fas fa-edit', Category::class)->setAction(Crud::PAGE_EDIT)
            ]);

            yield MenuItem::subMenu('Sous-Category', 'fa fa-')->setSubItems([
                MenuItem::linkToCrud('Ajouts de sous-catégorie', 'fas fa-plus', SousCategory::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des sous-catégorie', 'fas fa-eye', SousCategory::class),
                MenuItem::linkToCrud('Modifier les sous-catégorie', 'fas fa-edit', SousCategory::class)->setAction(Crud::PAGE_EDIT)
            ]);

            yield MenuItem::subMenu('Infos-contact', 'fa fa-')->setSubItems([
                MenuItem::linkToCrud('Ajouts d\'infos', 'fas fa-plus', InfosContact::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des infos', 'fas fa-eye', InfosContact::class),
                MenuItem::linkToCrud('Modifier les infos', 'fas fa-edit', InfosContact::class)->setAction(Crud::PAGE_EDIT)
            ]);


            yield MenuItem::linktoRoute('Retourner sur le site', 'fa fa-home', ('app_home_page') );

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
