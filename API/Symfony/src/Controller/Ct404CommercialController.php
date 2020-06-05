<?php

namespace App\Controller;

use App\Entity\Ct404Commercial;
use App\Form\Ct404CommercialType;
use App\Repository\Ct404CommercialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/commercial")
 */
class Ct404CommercialController extends AbstractController
{
    /**
     * @Route("/", name="ct404_commercial_index", methods={"GET"})
     */
    public function index(Ct404CommercialRepository $ct404CommercialRepository): Response
    {
        return $this->render('ct404_commercial/index.html.twig', [
            'ct404_commercials' => $ct404CommercialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct404_commercial_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Commercial = new Ct404Commercial();
        $form = $this->createForm(Ct404CommercialType::class, $ct404Commercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Commercial);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_commercial_index');
        }

        return $this->render('ct404_commercial/new.html.twig', [
            'ct404_commercial' => $ct404Commercial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_commercial_show", methods={"GET"})
     */
    public function show(Ct404Commercial $ct404Commercial): Response
    {
        return $this->render('ct404_commercial/show.html.twig', [
            'ct404_commercial' => $ct404Commercial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_commercial_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Commercial $ct404Commercial): Response
    {
        $form = $this->createForm(Ct404CommercialType::class, $ct404Commercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_commercial_index');
        }

        return $this->render('ct404_commercial/edit.html.twig', [
            'ct404_commercial' => $ct404Commercial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_commercial_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Commercial $ct404Commercial): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Commercial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Commercial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_commercial_index');
    }
}
