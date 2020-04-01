<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404Category.
 *
 * @ORM\Table(name="ct404_category")
 * @ORM\Entity
 */
class Ct404Category
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $categoryName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Category")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCategory;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdCategory(): ?self
    {
        return $this->idCategory;
    }

    public function setIdCategory(?self $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }
}
