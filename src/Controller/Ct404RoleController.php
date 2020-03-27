<?php

namespace App\Controller;

use App\Entity\Ct404Role;
use App\Form\Ct404RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/role")
 */
class Ct404RoleController extends AbstractController
{
    /**
     * @Route("/", name="ct404_role_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ct404Roles = $this->getDoctrine()
            ->getRepository(Ct404Role::class)
            ->findAll();

        return $this->render('ct404_role/index.html.twig', [
            'ct404_roles' => $ct404Roles,
        ]);
    }

    /**
     * @Route("/new", name="ct404_role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ct404Role = new Ct404Role();
        $form = $this->createForm(Ct404RoleType::class, $ct404Role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ct404Role);
            $entityManager->flush();

            return $this->redirectToRoute('ct404_role_index');
        }

        return $this->render('ct404_role/new.html.twig', [
            'ct404_role' => $ct404Role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_role_show", methods={"GET"})
     */
    public function show(Ct404Role $ct404Role): Response
    {
        return $this->render('ct404_role/show.html.twig', [
            'ct404_role' => $ct404Role,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct404_role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ct404Role $ct404Role): Response
    {
        $form = $this->createForm(Ct404RoleType::class, $ct404Role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct404_role_index');
        }

        return $this->render('ct404_role/edit.html.twig', [
            'ct404_role' => $ct404Role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct404_role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ct404Role $ct404Role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ct404Role->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ct404Role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct404_role_index');
    }
}
