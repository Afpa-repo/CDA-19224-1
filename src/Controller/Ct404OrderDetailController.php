<?php

namespace App\Controller;

use App\Entity\Ct404OrderDetail;
use App\Form\Ct404OrderDetailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/orderdetail")
 */
class Ct404OrderDetailController extends AbstractController
{
    /**
     * @Route("/", name="ct404_order_detail_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404OrderDetails = $this->getDoctrine()
            ->getRepository(Ct404OrderDetail::class)
            ->findAll()
        ;

        return $this->render('ct404_order_detail/index.html.twig', [
            'ct404_order_details' => $ct404OrderDetails,
        ]);
    }

    /**
     * @Route("/new", name="ct404_order_detail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404OrderDetail = new Ct404OrderDetail();
        $form = $this->createForm(Ct404OrderDetailType::class, $ct404OrderDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404OrderDetail);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_order_detail_index');
        }

        return $this->render('ct404_order_detail/new.html.twig', [
            'ct404_order_detail' => $ct404OrderDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_order_detail_show", methods={"GET"})
     */
    public function show(Ct404OrderDetail $ct404OrderDetail): Response
    {
        return $this->render('ct404_order_detail/show.html.twig', [
            'ct404_order_detail' => $ct404OrderDetail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_order_detail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404OrderDetail $ct404OrderDetail): Response
    {
        $form = $this->createForm(Ct404OrderDetailType::class, $ct404OrderDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_order_detail_index');
        }

        return $this->render('ct404_order_detail/edit.html.twig', [
            'ct404_order_detail' => $ct404OrderDetail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_order_detail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404OrderDetail $ct404OrderDetail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404OrderDetail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404OrderDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_order_detail_index');
    }
}
