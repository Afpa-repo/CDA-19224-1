<?php

namespace App\Controller;

use App\Repository\Ct404ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// Controller crée dans le but de tester le panier
class ProductController extends AbstractController
{
    /**
     * @Route("/produits", name="product_index")
     */
    public function index(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}
