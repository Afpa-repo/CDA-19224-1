<?php

namespace App\Controller;

use App\Entity\Ct404Particular;
use App\Form\Ct404Particular1Type;
use App\Repository\Ct404ParticularRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/particular")
 */
class Ct404ParticularController extends AbstractController
{
    /**
     * @Route("/", name="ct404_particular_index", methods={"GET"})
     */
    public function index(Ct404ParticularRepository $ct404ParticularRepository): Response
    {
        return $this->render('ct404_particular/index.html.twig', [
            'ct404_particulars' => $ct404ParticularRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct404_particular_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Particular = new Ct404Particular();
        $form = $this->createForm(Ct404Particular1Type::class, $ct404Particular);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Particular);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_particular_index');
        }

        return $this->render('ct404_particular/new.html.twig', [
            'ct404_particular' => $ct404Particular,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_particular_show", methods={"GET"})
     */
    public function show(Ct404Particular $ct404Particular): Response
    {
        return $this->render('ct404_particular/show.html.twig', [
            'ct404_particular' => $ct404Particular,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_particular_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Particular $ct404Particular): Response
    {
        $form = $this->createForm(Ct404Particular1Type::class, $ct404Particular);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_particular_index');
        }

        return $this->render('ct404_particular/edit.html.twig', [
            'ct404_particular' => $ct404Particular,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_particular_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Particular $ct404Particular): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Particular->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Particular);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_particular_index');
    }
}
