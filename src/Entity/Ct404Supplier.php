<?php

/* TODO:
 * Ajouter d'autres Validation
 * Pourquoi Strategy IDENTITY ?
 * Pourquoi il y a des INDEX ?
 * Vérifier que tout est bien là
 * Pourquoi il y a 2 fois UniqueEntity ?
 * Vérifier que les regex soient protégers contre les injections
 * Rajouter SIRET ?
 * */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ct404supplier.
 *
 * @ORM\Table(name="ct404_supplier")
 * @ORM\Entity
 * @UniqueEntity("supplier_name")
 * @UniqueEntity("supplier_mail")
 */
class Ct404Supplier
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
     * @ORM\Column(name="supplier_name", type="string", length=50, nullable=false, unique=true)
     */
    private $supplierName;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^[\w\d\.\,\(\)\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits"
     * )
     * @ORM\Column(name="supplier_address", type="string", length=255, nullable=false)
     */
    private $supplierAddress;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^[\w\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits"
     * )
     * @ORM\Column(name="supplier_city", type="string", length=50, nullable=false)
     */
    private $supplierCity;

    /**
     * @var int
     * @Assert\Regex(
     *     "/^\d{5}$/",
     *     message="Code postal invalide"
     * )
     * @ORM\Column(name="supplier_zip_code", type="integer", nullable=false)
     */
    private $supplierZipCode;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/",
     *     message="Votre numéro de téléphone n'est pas valide"
     * )
     * @ORM\Column(name="supplier_phone", type="string", length=30, nullable=false)
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

    public function getSupplierZipCode(): ?int
    {
        return $this->supplierZipCode;
    }

    public function setSupplierZipCode(int $supplierZipCode): self
    {
        $this->supplierZipCode = $supplierZipCode;

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
