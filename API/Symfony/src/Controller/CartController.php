<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller du panier utilisant le service CartService.
 */
class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     *
     * @return Response
     */
    public function index(CartService $cartService)
    {
        $Routes = [
            'Accueil' => '/',
            'Mon compte' => '/login',
            'Panier' => '/panier',
        ];

        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            'history_routes' => $Routes,
        ]);
    }

    /**
     * @Route("/panier/add{id}", name="cart_add")
     *
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute('cart_index', ['_fragment' => 'product'.$id]);
    }

    /**
     * @Route("/panier/modify{id}:{valeurUser}", name="cart_modify")
     *
     * @param mixed $id
     * @param mixed $valeurUser
     *
     * @return RedirectResponse
     */
    public function modify($id, $valeurUser, CartService $cartService)
    {
        $cartService->quantityUser($id, $valeurUser);

        return $this->redirectToRoute('cart_index', ['_fragment' => 'product'.$id]);
    }

    /**
     * @Route("/panier/subtract{id}", name="cart_subtract")
     *
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function subtract($id, CartService $cartService)
    {
        $cartService->subtract($id);

        return $this->redirectToRoute('cart_index', ['_fragment' => 'product'.$id]);
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     *
     * @param mixed $id
     *
     * @return RedirectResponse
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute('cart_index');
    }
}
