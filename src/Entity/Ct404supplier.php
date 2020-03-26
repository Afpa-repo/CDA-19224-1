<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404supplier
 *
 * @ORM\Table(name="ct404supplier")
 * @ORM\Entity
 */
class Ct404supplier
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
     * @ORM\Column(name="supplier_name", type="string", length=50, nullable=false)
     */
    private $supplierName;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_address", type="string", length=50, nullable=false)
     */
    private $supplierAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_city", type="string", length=50, nullable=false)
     */
    private $supplierCity;

    /**
     * @var int
     *
     * @ORM\Column(name="supplier_zipe_code", type="integer", nullable=false)
     */
    private $supplierZipeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_phone", type="string", length=14, nullable=false)
     */
    private $supplierPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_mail", type="string", length=50, nullable=false)
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
