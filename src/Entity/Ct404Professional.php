<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

date_default_timezone_set('Europe/Paris');

/**
 * Ct404Professional.
 *
 * @ORM\Table(name="ct404_professional", indexes={@ORM\Index(name="IDX_C08407583E4A79C1", columns={"password_id"})})
 * @ORM\Entity
 * @UniqueEntity("siret_number")
 * @UniqueEntity("mail")
 */
class Ct404Professional
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
     * @Assert\NotBlank()
     * @ORM\Column(name="siret_number", type="string", length=50, nullable=false, unique=true)
     */
    private $siretNumber;

    /**
     * @var string
     * @Assert\Regex("/^[\w\s\&\;\:\.\,\'\(\)\%""\?\!\€\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Voua utilisez des caractères interdits")
     * @ORM\Column(name="compagny_name", type="string", length=50, nullable=false)
     */
    private $compagnyName;

    /**
     * @var string
     * @Assert\Regex("/^[\w\-éèêëûüùîïíôöœàáâæç]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="contact_name", type="string", length=50, nullable=false)
     */
    private $contactName;

    /**
     * @var string
     * @Assert\Email(
     *     message="Votre adresse email n'est pas valide")
     * @ORM\Column(name="mail", type="string", length=50, nullable=false, unique=true)
     */
    private $mail;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="Problème d'enregistrement de la date"
     * )
     * @ORM\Column(name="date_register", type="datetime", nullable=false)
     */
    private $dateRegister;

    /**
     * @var string
     *
     * @ORM\Column(name="clef", type="string", length=100, nullable=false)
     */
    private $clef;

    /**
     * @var bool
     * @Assert\NotNull()
     * @ORM\Column(name="actif", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var \Ct404Commercial
     *
     * @ORM\ManyToOne(targetEntity="Ct404Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="password_id", referencedColumnName="id")
     * })
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siretNumber;
    }

    public function setSiretNumber(string $siretNumber): self
    {
        $this->siretNumber = $siretNumber;

        return $this;
    }

    public function getCompagnyName(): ?string
    {
        return $this->compagnyName;
    }

    public function setCompagnyName(string $compagnyName): self
    {
        $this->compagnyName = $compagnyName;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): self
    {
        $this->contactName = $contactName;

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

    public function getDateRegister(): ?\DateTimeInterface
    {
        return $this->dateRegister;
    }

    public function setDateRegister(\DateTimeInterface $dateRegister): self
    {
        $this->dateRegister = new DateTime();

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

    public function getPassword(): ?Ct404Commercial
    {
        return $this->password;
    }

    public function setPassword(?Ct404Commercial $password): self
    {
        $this->password = $password;

        return $this;
    }
}
