<?php

namespace App\Controller;

use App\Entity\Ct404Ordered;
use App\Form\Ct404OrderedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ordered")
 */
class Ct404OrderedController extends AbstractController
{
    /**
     * @Route("/", name="ct404_ordered_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404ordereds = $this->getDoctrine()
            ->getRepository(Ct404Ordered::class)
            ->findAll();

        return $this->render('ct404_ordered/index.html.twig', [
            'ct404ordereds' => $ct404ordereds,
        ]);
    }

    /**
     * @Route("/new", name="ct404_ordered_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404ordered = new Ct404Ordered();
        $form = $this->createForm(Ct404OrderedType::class, $ct404ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404ordered);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_ordered_index');
        }

        return $this->render('ct404_ordered/new.html.twig', [
            'ct404ordered' => $ct404ordered,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_ordered_show", methods={"GET"})
     */
    public function show(Ct404Ordered $ct404ordered): Response
    {
        return $this->render('ct404_ordered/show.html.twig', [
            'ct404ordered' => $ct404ordered,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_ordered_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Ordered $ct404ordered): Response
    {
        $form = $this->createForm(Ct404OrderedType::class, $ct404ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_ordered_index');
        }

        return $this->render('ct404_ordered/edit.html.twig', [
            'ct404ordered' => $ct404ordered,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_ordered_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Ordered $ct404ordered): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404ordered->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404ordered);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_ordered_index');
    }
}
