<?php

namespace App\Controller;

use App\Entity\Ct404ordered;
use App\Form\Ct404orderedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404ordered")
 */
class Ct404orderedController extends AbstractController
{
    /**
     * @Route("/", name="ct404ordered_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404ordereds = $this->getDoctrine()
            ->getRepository(Ct404ordered::class)
            ->findAll();

        return $this->render('ct404ordered/index.html.twig', [
            'ct404ordereds' => $ct404ordereds,
        ]);
    }

    /**
     * @Route("/new", name="ct404ordered_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404ordered = new Ct404ordered();
        $form = $this->createForm(Ct404orderedType::class, $ct404ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404ordered);
            $entityManager->flush();

            return $this->redirectToRoute('ct404ordered_index');
        }

        return $this->render('ct404ordered/new.html.twig', [
            'ct404ordered' => $ct404ordered,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404ordered_show", methods={"GET"})
     */
    public function show(Ct404ordered $ct404ordered): Response
    {
        return $this->render('ct404ordered/show.html.twig', [
            'ct404ordered' => $ct404ordered,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404ordered_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404ordered $ct404ordered): Response
    {
        $form = $this->createForm(Ct404orderedType::class, $ct404ordered);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404ordered_index');
        }

        return $this->render('ct404ordered/edit.html.twig', [
            'ct404ordered' => $ct404ordered,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404ordered_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404ordered $ct404ordered): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404ordered->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404ordered);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404ordered_index');
    }
}
