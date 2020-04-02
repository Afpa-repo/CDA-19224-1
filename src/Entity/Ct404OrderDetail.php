<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_order_detail")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404OrderDetailRepository")
 */
class Ct404OrderDetail
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La quantité est requise"
     * )
     * @Assert\Range(
     *     max="999999",
     *     min="1",
     *     maxMessage="La quantité ne peut pas être supérieure à {{ limit }}",
     *     minMessage="La quantité ne peut pas être inférieure à {{ limit }}"
     * )
     * @ORM\Column(type="string", length=6, nullable=false)
     */
    private $quantity;

    /**
     * @var Ct404Ordered
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Ordered", inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cOrder;

    /**
     * @var Ct404Product
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Product", inversedBy="orderDetail")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    // TODO Trouver un meilleur nom parce que order un mot déjà pris par PHP ou Symfony

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCOrder(): ?Ct404Ordered
    {
        return $this->cOrder;
    }

    public function setCOrder(?Ct404Ordered $cOrder): self
    {
        $this->cOrder = $cOrder;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Ct404Product
    {
        return $this->product;
    }

    public function setProduct(?Ct404Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
