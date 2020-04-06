<?php

namespace App\Controller;

use App\Entity\Ct404Supplier;
use App\Form\Ct404Supplier1Type;
use App\Repository\Ct404SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/supplier")
 */
class Ct404SupplierController extends AbstractController
{
    /**
     * @Route("/", name="ct404_supplier_index", methods={"GET"})
     */
    public function index(Ct404SupplierRepository $ct404SupplierRepository): Response
    {
        return $this->render('ct404_supplier/index.html.twig', [
            'ct404_suppliers' => $ct404SupplierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct404_supplier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Supplier = new Ct404Supplier();
        $form = $this->createForm(Ct404Supplier1Type::class, $ct404Supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Supplier);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_supplier_index');
        }

        return $this->render('ct404_supplier/new.html.twig', [
            'ct404_supplier' => $ct404Supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_supplier_show", methods={"GET"})
     */
    public function show(Ct404Supplier $ct404Supplier): Response
    {
        return $this->render('ct404_supplier/show.html.twig', [
            'ct404_supplier' => $ct404Supplier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_supplier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Supplier $ct404Supplier): Response
    {
        $form = $this->createForm(Ct404Supplier1Type::class, $ct404Supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_supplier_index');
        }

        return $this->render('ct404_supplier/edit.html.twig', [
            'ct404_supplier' => $ct404Supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_supplier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Supplier $ct404Supplier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Supplier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Supplier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_supplier_index');
    }
}
