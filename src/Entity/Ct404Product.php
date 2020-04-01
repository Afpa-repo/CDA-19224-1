<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ct404Product.
 *
 * @ORM\Table(name="ct404_product", indexes={@ORM\Index(name="IDX_DABC5B583688741C", columns={"id_ct404_supplier_id"}), @ORM\Index(name="IDX_DABC5B58B56FCC00", columns={"idct404_category_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\Ct404ProductRepository")
 */
class Ct404Product
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
     * @Assert\Regex(
     *     "/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits"
     * )
     * @ORM\Column(name="product_name", type="string", length=50, nullable=false)
     */
    private $productName;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^[\w\s\&\;\:\.\,\'\(\)\%""\?\!\€\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits"
     * )
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var float
     * @Assert\Regex(
     *     "/^([\d]{1,9}((\.|\,){1}[\d]{0,2})?)$/",
     *      message="Le prix c'est pas valide"
     * )
     * @ORM\Column(name="price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     * @Assert\Range(
     *     min="1",
     *     minMessage="Vous devez acheter au moins 1 article",
     *     max="10000",
     *     maxMessage="Vous pouvez acheter au maximum 10000 articles"
     * )
     * @ORM\Column(name="quantity_stock", type="string", length=11, nullable=false)
     */
    private $quantityStock;

    /**
     * @var string
     * @Assert\Range(
     *     min="1",
     *     minMessage="Vous devez acheter au moins 1 article",
     *     max="10000",
     *     maxMessage="Vous pouvez acheter au maximum 10000 articles"
     * )
     * @ORM\Column(name="quantity_of_alerte", type="string", length=11, nullable=false)
     */
    private $quantityOfAlert;

    /**
     * @var Ct404Supplier
     * @Assert\Positive()
     * @ORM\ManyToOne(targetEntity="Ct404Supplier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ct404_supplier_id", referencedColumnName="id")
     * })
     */
    private $idCt404Supplier;

    /**
     * @var Ct404Category
     * @Assert\Positive()
     * @ORM\ManyToOne(targetEntity="Ct404Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idct404_category_id", referencedColumnName="id")
     * })
     */
    private $idCt404Category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantityStock(): ?string
    {
        return $this->quantityStock;
    }

    public function setQuantityStock(string $quantityStock): self
    {
        $this->quantityStock = $quantityStock;

        return $this;
    }

    public function getQuantityOfAlert(): ?string
    {
        return $this->quantityOfAlert;
    }

    public function setQuantityOfAlert(string $quantityOfAlert): self
    {
        $this->quantityOfAlert = $quantityOfAlert;

        return $this;
    }

    public function getIdCt404Supplier(): ?Ct404Supplier
    {
        return $this->idCt404Supplier;
    }

    public function setIdCt404Supplier(?Ct404Supplier $idCt404Supplier): self
    {
        $this->idCt404Supplier = $idCt404Supplier;

        return $this;
    }

    public function getIdCt404Category(): ?Ct404Category
    {
        return $this->idCt404Category;
    }

    public function setIdCt404Category(?Ct404Category $idCt404Category): self
    {
        $this->idCt404Category = $idCt404Category;

        return $this;
    }
}
