<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_supplier")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404SupplierRepository")
 * @UniqueEntity(
 *     errorPath="supplierMail",
 *     fields={"supplierMail", "supplierName"},
 *     message="Ce mail et/ou nom sont déjà pris"
 * )
 */
class Ct404Supplier
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
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un nom valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="L'adresse est requise"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\d\.\,\(\)\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas une adresse valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $address;

    /**
     * @Assert\NotBlank(
     *     message="La ville est requise"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas une ville valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var int
     * @Assert\NotBlank(
     *     message="Le code postal est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^\d{5}$/",
     *     message="{{ value }} n'est pas un code postal valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="integer", nullable=false)
     */
    private $zipCode;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Le numéro de téléphone est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^(0{1}\d{9})$/",
     *     message="{{ value }} n'est pas un numéro de téléphone valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $phoneNumber;

    /**
     * @var string
     * @Assert\Email(
     *     message="{{ value }} n'est pas un email valide",
     *     mode="strict"
     * )
     * @Assert\NotBlank(
     *     message="L'email est requis"
     * )
     * @ORM\Column(type="string", length=100, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var Ct404Product
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404Product", mappedBy="supplier", orphanRemoval=true)
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $product->setSupplier($this);
        }

        return $this;
    }

    public function removeProduct(Ct404Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);

            if ($product->getSupplier() === $this) {
                $product->setSupplier(null);
            }
        }

        return $this;
    }
}
