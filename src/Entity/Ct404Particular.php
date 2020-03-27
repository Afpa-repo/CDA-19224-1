<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
date_default_timezone_set("Europe/Paris");

/**
 * Ct404particular
 *
 * @ORM\Table(name="ct404particular", indexes={@ORM\Index(name="IDX_59A290B961DDAC3C", columns={"id_ct404_role_id"}), @ORM\Index(name="IDX_59A290B96D7E3993", columns={"id_ct404_commercial_id"})})
 * @ORM\Entity
 */
class Ct404Particular
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
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=5, nullable=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=false)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=50, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="clef", type="string", length=100, nullable=false)
     */
    private $clef;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_registeur", type="datetime", nullable=false)
     */
    private $dateRegisteur;

    /**
     * @var \Ct404Role
     *
     * @ORM\ManyToOne(targetEntity="Ct404Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ct404_role_id", referencedColumnName="id")
     * })
     */
    private $idCt404Role;

    /**
     * @var \Ct404Commercial
     *
     * @ORM\ManyToOne(targetEntity="Ct404Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ct404_commercial_id", referencedColumnName="id")
     * })
     */
    private $idCt404Commercial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getClef(): ?string
    {
        return $this->clef;
    }

    public function setClef(string $clef): self
    {
        $this->clef = $clef;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getDateRegisteur(): ?\DateTimeInterface
    {
        return $this->dateRegisteur;
    }

    public function setDateRegisteur(\DateTimeInterface $dateRegisteur): self
    {
        $this->dateRegisteur = new \DateTime();

        return $this;
    }

    public function getIdCt404Role(): ?Ct404Role
    {
        return $this->idCt404Role;
    }

    public function setIdCt404Role(?Ct404Role $idCt404Role): self
    {
        $this->idCt404Role = $idCt404Role;

        return $this;
    }

    public function getIdCt404Commercial(): ?Ct404Commercial
    {
        return $this->idCt404Commercial;
    }

    public function setIdCt404Commercial(?Ct404Commercial $idCt404Commercial): self
    {
        $this->idCt404Commercial = $idCt404Commercial;

        return $this;
    }


}
