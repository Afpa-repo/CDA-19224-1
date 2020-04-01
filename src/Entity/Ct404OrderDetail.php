<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ct404OrderDetail.
 *
 * @ORM\Table(name="ct404_order_detail", indexes={@ORM\Index(name="IDX_ED896F46274A2535", columns={"idorder_id"}), @ORM\Index(name="IDX_ED896F46E00EE68D", columns={"id_product_id"})})
 * @ORM\Entity
 */
class Ct404OrderDetail
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\Range(
     *     min="1",
     *     minMessage="Vous devez acheter au moins 1 article",
     *     max="10000",
     *     maxMessage="Vous pouvez acheter au maximum 10000 articles"
     * )
     * @ORM\Column(name="quantity", type="string", length=11, nullable=false)
     */
    private $quantity;

    /**
     * @var Ct404Ordered
     * @Assert\Positive()
     * @ORM\ManyToOne(targetEntity="Ct404Ordered")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idorder_id", referencedColumnName="id")
     * })
     */
    private $idOrder;

    /**
     * @var Ct404Product
     * @Assert\Positive()
     * @ORM\ManyToOne(targetEntity="Ct404Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_product_id", referencedColumnName="id")
     * })
     */
    private $idProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIdOrder(): ?Ct404Ordered
    {
        return $this->idOrder;
    }

    public function setIdOrder(?Ct404Ordered $idOrder): self
    {
        $this->idOrder = $idOrder;

        return $this;
    }

    public function getIdProduct(): ?Ct404Product
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Ct404Product $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }
}
