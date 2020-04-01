<?php

namespace App\Service\Cart;

use App\Repository\Ct404ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// Le service CartService comprenant les méthodes liées au panier
// TODO: Ajouter une des méthodes pour incrémenter et  décrémenter la quantité d'un produit directement dans le panier
class CartService
{
    protected $session;
    protected $Ct404ProductRepository;

    public function __construct(SessionInterface $session, Ct404ProductRepository $Ct404ProductRepository)
    {
        $this->session = $session;
        $this->Ct404ProductRepository = $Ct404ProductRepository;
    }

    // Ajout panier
    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);
        // si le produit est déjà dans le panier, on incrémente sa quantité
        if (!empty($panier[$id])) {
            ++$panier[$id];
        } else {
            // sinon, on lui attribue la valeur 1
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    // Réduire quantité panier
    public function subtract(int $id)
    {
        $panier = $this->session->get('panier', []);
        // si le produit est déjà dans le panier, on décrémente sa quantité
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                --$panier[$id];
            } else {
                unset($panier[$id]);
            }
        }

        $this->session->set('panier', $panier);
    }

    // Suppression d'un produit du panier
    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);
        // Si le produit est dans le panier, on le supprime
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

    // Affichage du panier
    public function getFullCart(): array
    {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->Ct404ProductRepository->find($id),
                'quantity' => $quantity,
            ];
        }

        return $panierWithData;
    }

    // Prix total de tous les produits du panier
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getFullCart() as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }

        return $total;
    }
}
