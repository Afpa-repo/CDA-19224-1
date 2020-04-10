<?php

namespace App\Controller;

use App\Repository\Ct404ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/baguettes", name="productChopsticks")
     */
    public function chopsticks(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findByCategory(1),
            'category' => "Baguettes",
        ]);
    }

    /**
     * @Route("/vêtements", name="productClothing")
     */
    public function clothing(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findByCategory(2),
            'category' => "Vêtements",
        ]);
    }

    /**
     * @Route("/bijoux", name="productJewelry")
     */
    public function jewelry(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findByCategory(3),
            'category' => "Bijoux",
        ]);
    }

    /**
     * @Route("/papeterie", name="productStationery")
     */
    public function stationery(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findByCategory(4),
            'category' => "Papeterie",
        ]);
    }

    /**
     * @Route("/accessoires", name="productAccessories")
     */
    public function accessories(Ct404ProductRepository $productRepository)
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findByVategory(5),
            'category' => "Accessoires",
        ]);
    }
}
