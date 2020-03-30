<?php

namespace App\Controller;

use App\Entity\Ct404Supplier;
use App\Form\Ct404SupplierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/supplier")
 */
class Ct404SupplierController extends AbstractController
{
    /**
     * @Route("/", name="ct404_supplier_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404suppliers = $this->getDoctrine()
            ->getRepository(Ct404Supplier::class)
            ->findAll()
        ;

        return $this->render('ct404_supplier/index.html.twig', [
            'ct404suppliers' => $ct404suppliers,
        ]);
    }

    /**
     * @Route("/new", name="ct404_supplier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404supplier = new Ct404Supplier();
        $form = $this->createForm(Ct404SupplierType::class, $ct404supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404supplier);
            $entityManager->flush();

            return $this->redirectToRoute('ct404supplier_index');
        }

        return $this->render('ct404_supplier/new.html.twig', [
            'ct404supplier' => $ct404supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_supplier_show", methods={"GET"})
     */
    public function show(Ct404Supplier $ct404supplier): Response
    {
        return $this->render('ct404_supplier/show.html.twig', [
            'ct404supplier' => $ct404supplier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_supplier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Supplier $ct404supplier): Response
    {
        $form = $this->createForm(Ct404SupplierType::class, $ct404supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_supplier_index');
        }

        return $this->render('ct404_supplier/edit.html.twig', [
            'ct404supplier' => $ct404supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_supplier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Supplier $ct404supplier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404supplier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404supplier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_supplier_index');
    }
}
