<?php

namespace App\Controller;

use App\Entity\Ct404Product;
use App\Form\Ct404Product1Type;
use App\Repository\Ct404ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/product")
 */
class Ct404ProductController extends AbstractController
{
    /**
     * @Route("/", name="ct404_product_index", methods={"GET"})
     */
    public function index(Ct404ProductRepository $ct404ProductRepository): Response
    {
        return $this->render('ct404_product/index.html.twig', [
            'ct404_products' => $ct404ProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct404_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Product = new Ct404Product();
        $form = $this->createForm(Ct404Product1Type::class, $ct404Product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Product);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_product_index');
        }

        return $this->render('ct404_product/new.html.twig', [
            'ct404_product' => $ct404Product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_product_show", methods={"GET"})
     */
    public function show(Ct404Product $ct404Product): Response
    {
        return $this->render('ct404_product/show.html.twig', [
            'ct404_product' => $ct404Product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Product $ct404Product): Response
    {
        $form = $this->createForm(Ct404Product1Type::class, $ct404Product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_product_index');
        }

        return $this->render('ct404_product/edit.html.twig', [
            'ct404_product' => $ct404Product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Product $ct404Product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_product_index');
    }
}
