<?php

namespace App\Controller;

use App\Entity\Ct404particular;
use App\Form\Ct404particularType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/particular")
 */
class Ct404particularController extends AbstractController
{
    /**
     * @Route("/", name="ct404particular_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404particulars = $this->getDoctrine()
            ->getRepository(Ct404particular::class)
            ->findAll();

        return $this->render('ct404particular/index.html.twig', [
            'ct404particulars' => $ct404particulars,
        ]);
    }

    /**
     * @Route("/new", name="ct404particular_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404particular = new Ct404particular();
        $form = $this->createForm(Ct404particularType::class, $ct404particular);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404particular);
            $entityManager->flush();

            return $this->redirectToRoute('ct404particular_index');
        }

        return $this->render('ct404particular/new.html.twig', [
            'ct404particular' => $ct404particular,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404particular_show", methods={"GET"})
     */
    public function show(Ct404particular $ct404particular): Response
    {
        return $this->render('ct404particular/show.html.twig', [
            'ct404particular' => $ct404particular,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404particular_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404particular $ct404particular): Response
    {
        $form = $this->createForm(Ct404particularType::class, $ct404particular);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404particular_index');
        }

        return $this->render('ct404particular/edit.html.twig', [
            'ct404particular' => $ct404particular,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404particular_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404particular $ct404particular): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404particular->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404particular);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404particular_index');
    }
}
