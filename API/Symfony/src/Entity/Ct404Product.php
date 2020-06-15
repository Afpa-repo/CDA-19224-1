<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_product")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404ProductRepository")
 */
class Ct404Product
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
     *     message="Le nom du produit est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un nom valide",
     *     normalizer="trim"
     * )
     * @Assert\Length(
     *     max="100",
     *     min="3",
     *     maxMessage="Le nom du produit doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le nom du produit doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La description est requise"
     * )
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @var float
     * @Assert\NotBlank(
     *     message="Le prix est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^([\d]{1,9}((\.|\,){1}[\d]{0,2})?)$/",
     *     message="{{ value }} n'est pas un prix valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La quantité de stock est requise"
     * )
     * @Assert\Range(
     *     max="999999",
     *     min="1",
     *     maxMessage="La quantité de stock ne peut pas être supérieure à {{ limit }}",
     *     minMessage="La quantité de stock ne peut pas être inférieure à {{ limit }}"
     * )
     * @ORM\Column(type="string", length=6, nullable=false)
     */
    private $stockQuantity;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La quantité d'alerte est requise"
     * )
     * @Assert\Range(
     *     max="999999",
     *     min="1",
     *     maxMessage="La quantité d'alerte ne peut pas être supérieure à {{ limit }}",
     *     minMessage="La quantité d'alerte ne peut pas être inférieure à {{ limit }}"
     * )
     * @ORM\Column(type="string", length=6, nullable=false)
     */
    private $alertQuantity;

    /**
     * @var Ct404Supplier
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Supplier", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

    /**
     * @var Ct404OrderDetail
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404OrderDetail", mappedBy="product")
     * @ORM\JoinColumn(nullable=true)
     */
    private $orderDetail;

    /**
     * @var Ct404SubCategory
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404SubCategory", inversedBy="products_list")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sub_category;

    public function __construct()
    {
        $this->orderDetail = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getStockQuantity(): ?string
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(string $stockQuantity): self
    {
        $this->stockQuantity = $stockQuantity;

        return $this;
    }

    public function getAlertQuantity(): ?string
    {
        return $this->alertQuantity;
    }

    public function setAlertQuantity(string $alertQuantity): self
    {
        $this->alertQuantity = $alertQuantity;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplier(): ?Ct404Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Ct404Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getOrderDetail(): Collection
    {
        return $this->orderDetail;
    }

    public function addOrderDetail(Ct404OrderDetail $orderDetail): self
    {
        if (!$this->orderDetail->contains($orderDetail)) {
            $this->orderDetail[] = $orderDetail;
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(Ct404OrderDetail $orderDetail): self
    {
        if ($this->orderDetail->contains($orderDetail)) {
            $this->orderDetail->removeElement($orderDetail);

            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    public function getSubCategory(): ?Ct404SubCategory
    {
        return $this->sub_category;
    }

    public function setSubCategory(?Ct404SubCategory $sub_category): self
    {
        $this->sub_category = $sub_category;

        return $this;
    }
}
