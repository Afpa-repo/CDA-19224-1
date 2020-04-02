<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ct404SubCategoryRepository")
 */
class Ct404SubCategory
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
     *     maxMessage="Le nom de la sous catégorie doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le nom de la sous catégorie doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var Ct404Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Category", inversedBy="subCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?Ct404Category
    {
        return $this->category;
    }

    public function setCategory(?Ct404Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
