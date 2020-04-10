<?php

namespace App\Controller;

use App\Entity\Ct404Category;
use App\Entity\Ct404Product;
use App\Entity\Ct404SubCategory;
use App\Form\Ct404ProductType;
use App\Repository\Ct404CategoryRepository;
use App\Repository\Ct404ProductRepository;
use App\Repository\Ct404SubCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct404/product")
 */
class Ct404ProductController extends AbstractController
{
    /**
     * @Route("/", name="ct404_product_index", methods={"GET"})
     */
    public function index(Ct404ProductRepository $ct404ProductRepository): Response
    {
        return $this->render('ct404_product/index.html.twig', [
            'ct404_products' => $ct404ProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_product_sub_category", methods={"GET"})
     */
    public function bySubCategory(Ct404SubCategoryRepository $ct404SubCategoryRepository, Ct404SubCategory $subCategory_entity, Ct404ProductRepository $ct404ProductRepository): Response
    {
        $sub_category_id = $subCategory_entity->getId();

        $products = $ct404ProductRepository->findBy([
            'sub_category' => $sub_category_id,
        ]);

        $current_sub_category = $ct404SubCategoryRepository->findOneBy([
            'id' => $sub_category_id,
        ]);

        return $this->render('ct404_product/products_by_subcategory.html.twig', [
            'ct404_products' => $products,
            'current_sub_category' => $current_sub_category,
        ]);
    }

    /**
     * @Route("/all/{id}", name="ct404_product_category", methods={"GET"})
     */
    public function byCategory(Ct404Category $category_entity, Ct404ProductRepository $ct404ProductRepository, Ct404CategoryRepository $ct404CategoryRepository): Response
    {
        $category_id = $category_entity->getId();

        $products = $ct404ProductRepository->findByCategory($category_id);

        $current_sub_category = $ct404CategoryRepository->findOneBy([
            'id' => $category_id,
        ]);

        return $this->render('ct404_product/products_by_subcategory.html.twig', [
            'ct404_products' => $products,
            'current_sub_category' => $current_sub_category,
        ]);
    }

    /**
     * @Route("/new", name="ct404_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Product = new Ct404Product();
        $form = $this->createForm(Ct404ProductType::class, $ct404Product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Product);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_product_index');
        }

        return $this->render('ct404_product/new.html.twig', [
            'ct404_product' => $ct404Product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="ct404_product_show", methods={"GET"})
     */
    public function show(Ct404Product $ct404Product): Response
    {
        return $this->render('ct404_product/show.html.twig', [
            'ct404_product' => $ct404Product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Product $ct404Product): Response
    {
        $form = $this->createForm(Ct404ProductType::class, $ct404Product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_product_index');
        }

        return $this->render('ct404_product/edit.html.twig', [
            'ct404_product' => $ct404Product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Product $ct404Product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_product_index');
    }
}
