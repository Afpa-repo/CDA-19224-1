<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404Product
 *
 * @ORM\Table(name="ct404_product", indexes={@ORM\Index(name="IDX_DABC5B583688741C", columns={"id_ct404_supplier_id"}), @ORM\Index(name="IDX_DABC5B58B56FCC00", columns={"idct404_category_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\Ct404ProductRepository")
 */
class Ct404Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=50, nullable=false)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity_stock", type="string", length=11, nullable=false)
     */
    private $quantityStock;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity_of_alerte", type="string", length=11, nullable=false)
     */
    private $quantityOfAlerte;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=255, nullable=false)
     */
    private $categoryName;

    /**
     * @var \Ct404Supplier
     *
     * @ORM\ManyToOne(targetEntity="Ct404Supplier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ct404_supplier_id", referencedColumnName="id")
     * })
     */
    private $idCt404Supplier;

    /**
     * @var \Ct404Category
     *
     * @ORM\ManyToOne(targetEntity="Ct404Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idct404_category_id", referencedColumnName="id")
     * })
     */
    private $idct404Category;

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

    public function getQuantityOfAlerte(): ?string
    {
        return $this->quantityOfAlerte;
    }

    public function setQuantityOfAlerte(string $quantityOfAlerte): self
    {
        $this->quantityOfAlerte = $quantityOfAlerte;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

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

    public function getIdct404Category(): ?Ct404Category
    {
        return $this->idct404Category;
    }

    public function setIdct404Category(?Ct404Category $idct404Category): self
    {
        $this->idct404Category = $idct404Category;

        return $this;
    }


}
