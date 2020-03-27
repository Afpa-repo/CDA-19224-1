<?php

namespace App\Controller;

use App\Entity\Ct404commercial;
use App\Form\Ct404commercialType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commercial")
 */
class Ct404commercialController extends AbstractController
{
    /**
     * @Route("/", name="ct404commercial_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404commercials = $this->getDoctrine()
            ->getRepository(Ct404commercial::class)
            ->findAll();

        return $this->render('ct404commercial/index.html.twig', [
            'ct404commercials' => $ct404commercials,
        ]);
    }

    /**
     * @Route("/new", name="ct404commercial_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404commercial = new Ct404commercial();
        $form = $this->createForm(Ct404commercialType::class, $ct404commercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404commercial);
            $entityManager->flush();

            return $this->redirectToRoute('ct404commercial_index');
        }

        return $this->render('ct404commercial/new.html.twig', [
            'ct404commercial' => $ct404commercial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404commercial_show", methods={"GET"})
     */
    public function show(Ct404commercial $ct404commercial): Response
    {
        return $this->render('ct404commercial/show.html.twig', [
            'ct404commercial' => $ct404commercial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404commercial_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404commercial $ct404commercial): Response
    {
        $form = $this->createForm(Ct404commercialType::class, $ct404commercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404commercial_index');
        }

        return $this->render('ct404commercial/edit.html.twig', [
            'ct404commercial' => $ct404commercial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404commercial_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404commercial $ct404commercial): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404commercial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404commercial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404commercial_index');
    }
}
