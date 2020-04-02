<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_category")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404CategoryRepository")
 */
class Ct404Category
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
     *     message="Le nom est requis"
     * )
     * @Assert\Length(
     *     max="50",
     *     min="3",
     *     maxMessage="Le nom de la catégorie doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le nom de la catégorie doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var Ct404Product
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404Product", mappedBy="category", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $products;

    /**
     * @var Ct404SubCategory
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404SubCategory", mappedBy="category", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $subCategories;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Ct404Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Ct404Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);

            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(Ct404SubCategory $subCategory): self
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories[] = $subCategory;
            $subCategory->setCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(Ct404SubCategory $subCategory): self
    {
        if ($this->subCategories->contains($subCategory)) {
            $this->subCategories->removeElement($subCategory);

            if ($subCategory->getCategory() === $this) {
                $subCategory->setCategory(null);
            }
        }

        return $this;
    }
}
