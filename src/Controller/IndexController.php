<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // Define Routes to display the current location
        // The 'breadcrumb' Materialize is not required
        /* If you want use this, you have to inject precisely
        'history_route' to the base.html contained in all pages */
        $Routes = [
            'Accueil' => '/',
        ];

        return $this->render('pages/index.html.twig', [
            'history_routes' => $Routes,
        ]);
    }
}
