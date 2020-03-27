<?php

namespace App\Controller;

use App\Entity\Ct404Professional;
use App\Form\Ct404ProfessionalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/professional")
 */
class Ct404ProfessionalController extends AbstractController
{
    /**
     * @Route("/", name="ct404_professional_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404Professionals = $this->getDoctrine()
            ->getRepository(Ct404Professional::class)
            ->findAll();

        return $this->render('ct404_professional/index.html.twig', [
            'ct404_professionals' => $ct404Professionals,
        ]);
    }

    /**
     * @Route("/new", name="ct404_professional_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Professional = new Ct404Professional();
        $form = $this->createForm(Ct404ProfessionalType::class, $ct404Professional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Professional);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_professional_index');
        }

        return $this->render('ct404_professional/new.html.twig', [
            'ct404_professional' => $ct404Professional,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_professional_show", methods={"GET"})
     */
    public function show(Ct404Professional $ct404Professional): Response
    {
        return $this->render('ct404_professional/show.html.twig', [
            'ct404_professional' => $ct404Professional,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_professional_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Professional $ct404Professional): Response
    {
        $form = $this->createForm(Ct404ProfessionalType::class, $ct404Professional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_professional_index');
        }

        return $this->render('ct404_professional/edit.html.twig', [
            'ct404_professional' => $ct404Professional,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_professional_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Professional $ct404Professional): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Professional->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Professional);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_professional_index');
    }
}
