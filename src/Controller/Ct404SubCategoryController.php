<?php

namespace App\Controller;

use App\Entity\Ct404SubCategory;
use App\Form\Ct404SubCategoryType;
use App\Repository\Ct404CategoryRepository;
use App\Repository\Ct404SubCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/sub/category")
 */
class Ct404SubCategoryController extends AbstractController
{
    /**
     * @Route("/", name="ct404_sub_category_index", methods={"GET"})
     */
    public function index(Ct404SubCategoryRepository $ct404SubCategoryRepository): Response
    {
        return $this->render('ct404_sub_category/index.html.twig', [
            'ct404_sub_categories' => $ct404SubCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{category}", name="ct404_sub_category", methods={"GET"})
     */
    public function byCategory(Ct404SubCategory $sub_categories_entity, Ct404SubCategoryRepository $ct404SubCategoryRepository, Ct404CategoryRepository $ct404CategoryRepository): Response
    {
        $category_id = $sub_categories_entity->getCategory();

        $sub_categories = $ct404SubCategoryRepository->findBy([
            'category' => $category_id,
        ]);

        $current_category = $ct404CategoryRepository->findOneBy([
            'id' => $category_id,
        ]);
        dump($category_id);

        return $this->render('ct404_sub_category/child_by_parent.html.twig', [
            'ct404_sub_categories' => $sub_categories,
            'current_category' => $current_category,
        ]);
    }

    /**
     * @Route("/new", name="ct404_sub_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404SubCategory = new Ct404SubCategory();
        $form = $this->createForm(Ct404SubCategoryType::class, $ct404SubCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404SubCategory);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_sub_category_index');
        }

        return $this->render('ct404_sub_category/new.html.twig', [
            'ct404_sub_category' => $ct404SubCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_sub_category_show", methods={"GET"})
     */
    public function show(Ct404SubCategory $ct404SubCategory): Response
    {
        return $this->render('ct404_sub_category/show.html.twig', [
            'ct404_sub_category' => $ct404SubCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_sub_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404SubCategory $ct404SubCategory): Response
    {
        $form = $this->createForm(Ct404SubCategoryType::class, $ct404SubCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_sub_category_index');
        }

        return $this->render('ct404_sub_category/edit.html.twig', [
            'ct404_sub_category' => $ct404SubCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_sub_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404SubCategory $ct404SubCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404SubCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404SubCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_sub_category_index');
    }
}
