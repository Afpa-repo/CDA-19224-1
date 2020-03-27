<?php

namespace App\Controller;

use App\Entity\Ct404supplier;
use App\Form\Ct404supplierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/supplier")
 */
class Ct404supplierController extends AbstractController
{
    /**
     * @Route("/", name="ct404supplier_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404suppliers = $this->getDoctrine()
            ->getRepository(Ct404supplier::class)
            ->findAll();

        return $this->render('ct404supplier/index.html.twig', [
            'ct404suppliers' => $ct404suppliers,
        ]);
    }

    /**
     * @Route("/new", name="ct404supplier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404supplier = new Ct404supplier();
        $form = $this->createForm(Ct404supplierType::class, $ct404supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404supplier);
            $entityManager->flush();

            return $this->redirectToRoute('ct404supplier_index');
        }

        return $this->render('ct404supplier/new.html.twig', [
            'ct404supplier' => $ct404supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404supplier_show", methods={"GET"})
     */
    public function show(Ct404supplier $ct404supplier): Response
    {
        return $this->render('ct404supplier/show.html.twig', [
            'ct404supplier' => $ct404supplier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404supplier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404supplier $ct404supplier): Response
    {
        $form = $this->createForm(Ct404supplierType::class, $ct404supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404supplier_index');
        }

        return $this->render('ct404supplier/edit.html.twig', [
            'ct404supplier' => $ct404supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404supplier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404supplier $ct404supplier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404supplier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404supplier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404supplier_index');
    }
}
