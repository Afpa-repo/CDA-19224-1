<?php

namespace App\Service\Cart;

use App\Repository\Ct404ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// Le service CartService comprenant les méthodes liées au panier
// TODO: Ajouter un moyen de permettre de directement modifier la quantité dans le panier, (input ou select ?)
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

    public function quantityUser(int $id, int $valeurUser)
    {
        htmlspecialchars($valeurUser);
        $panier = $this->session->get('panier', []);
        // si le produit est déjà dans le panier, on met la quantité rentré par l'utilisateur
        if (!empty($panier[$id]) && $valeurUser > 0) {
            $panier[$id] = $valeurUser;
        // l'utilisateur met 0 alors on le retire du panier
        } elseif (0 == $valeurUser) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
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
