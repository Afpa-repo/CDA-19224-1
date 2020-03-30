<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404supplier.
 *
 * @ORM\Table(name="ct404supplier")
 * @ORM\Entity
 * @UniqueEntity("supplier_name")
 * @UniqueEntity("supplier_mail")
 */
class Ct404Supplier
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
     * @Assert\Regex("/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="supplier_name", type="string", length=50, nullable=false, unique=true)
     */
    private $supplierName;

    /**
     * @var string
     * @Assert\Regex("/^[\w\d\.\,\(\)\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="supplier_address", type="string", length=50, nullable=false)
     */
    private $supplierAddress;

    /**
     * @var string
     * @Assert\Regex("/^[\w\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="supplier_city", type="string", length=50, nullable=false)
     */
    private $supplierCity;

    // TODO : Corriger le nom de variable
    /**
     * @var int
     * @Assert\Regex("/^\d{5}$/",
     *     message="Code postal invalide")
     * @ORM\Column(name="supplier_zipe_code", type="integer", nullable=false)
     */
    private $supplierZipeCode;

    /**
     * @var string
     * @Assert\Regex("/^(0{1}\d{9})$/",
     *     message="Votre numéro de téléphone n'est pas valide")
     * @ORM\Column(name="supplier_phone", type="string", length=14, nullable=false)
     */
    private $supplierPhone;

    /**
     * @var string
     * @Assert\Email(
     *     message="Votre adresse email n'est pas valide"
     * )
     * @ORM\Column(name="supplier_mail", type="string", length=50, nullable=false, unique=true)
     */
    private $supplierMail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierName(): ?string
    {
        return $this->supplierName;
    }

    public function setSupplierName(string $supplierName): self
    {
        $this->supplierName = $supplierName;

        return $this;
    }

    public function getSupplierAddress(): ?string
    {
        return $this->supplierAddress;
    }

    public function setSupplierAddress(string $supplierAddress): self
    {
        $this->supplierAddress = $supplierAddress;

        return $this;
    }

    public function getSupplierCity(): ?string
    {
        return $this->supplierCity;
    }

    public function setSupplierCity(string $supplierCity): self
    {
        $this->supplierCity = $supplierCity;

        return $this;
    }

    public function getSupplierZipeCode(): ?int
    {
        return $this->supplierZipeCode;
    }

    public function setSupplierZipeCode(int $supplierZipeCode): self
    {
        $this->supplierZipeCode = $supplierZipeCode;

        return $this;
    }

    public function getSupplierPhone(): ?string
    {
        return $this->supplierPhone;
    }

    public function setSupplierPhone(string $supplierPhone): self
    {
        $this->supplierPhone = $supplierPhone;

        return $this;
    }

    public function getSupplierMail(): ?string
    {
        return $this->supplierMail;
    }

    public function setSupplierMail(string $supplierMail): self
    {
        $this->supplierMail = $supplierMail;

        return $this;
    }
}
