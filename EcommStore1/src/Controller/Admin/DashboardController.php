<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Orders;
use App\Entity\Rayon;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ProductCrudController::class)
            ->generateUrl();

        return $this->redirect($url);

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
            ->setTitle('EcommStore1');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tous les produits', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Les rayons', 'fa-solid fa-shop', Rayon::class);
        yield MenuItem::linkToCrud('Les catégories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Vos commandes', 'fa-solid fa-paper-plane', Orders::class);
        yield MenuItem::linkToUrl('Retour sur le site', 'fa-solid fa-arrow-rotate-left', $this->generateUrl('app_home'));
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        if (!$user instanceof User){
            throw new \Exception('Wrong user');
        }

        return parent::configureUserMenu($user);
        //->setMenuItems(yield MenuItem::linkToUrl('user_menu1', 'fas fa-list', $this->generateUrl('test')));
    }


    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


}
