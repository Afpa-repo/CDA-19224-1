<?php

namespace App\Controller;

use App\Entity\Ct404Category;
use App\Form\Ct404CategoryType;
use App\Repository\Ct404CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/category")
 */
class Ct404CategoryController extends AbstractController
{
    /**
     * @Route("/", name="ct404_category_index", methods={"GET"})
     */
    public function index(Ct404CategoryRepository $ct404CategoryRepository): Response
    {
        return $this->render('ct404_category/index.html.twig', [
            'ct404_categories' => $ct404CategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ct404_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Category = new Ct404Category();
        $form = $this->createForm(Ct404CategoryType::class, $ct404Category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Category);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_category_index');
        }

        return $this->render('ct404_category/new.html.twig', [
            'ct404_category' => $ct404Category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_category_show", methods={"GET"})
     */
    public function show(Ct404Category $ct404Category): Response
    {
        return $this->render('ct404_category/show.html.twig', [
            'ct404_category' => $ct404Category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Category $ct404Category): Response
    {
        $form = $this->createForm(Ct404CategoryType::class, $ct404Category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_category_index');
        }

        return $this->render('ct404_category/edit.html.twig', [
            'ct404_category' => $ct404Category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Category $ct404Category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_category_index');
    }
}
