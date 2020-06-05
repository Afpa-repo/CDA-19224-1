<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_professional")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404ProfessionalRepository")
 * @UniqueEntity(
 *     errorPath="email",
 *     fields={"email", "siret"},
 *     message="L'email et/ou le n° de SIRET sont déjà pris"
 * )
 */
class Ct404Professional
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
     *     message="Le n° de SIRET est requis"
     * )
     * @Assert\Length(
     *     max="17",
     *     maxMessage="Le n° de SIRET doit faire au maximum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\d]{3}\s[\d]{3}\s[\d]{3}\s[\d]{5}$/",
     *     message="{{ value }} n'est pas un n° de SIRET valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=17, nullable=false)
     */
    private $siret;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Le nom de l'entreprise est requis"
     * )
     * @Assert\Length(
     *     max="100",
     *     maxMessage="Le nom de l'entreprise doit faire au maximum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un nom d'entreprise valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $company;

    /**
     * @var string
     * @Assert\Email(
     *     message="{{ value }} n'est pas un email valide",
     *     mode="strict"
     * )
     * @Assert\NotBlank(
     *     message="L'email est requis"
     * )
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $companyEmail;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="{{ value }} n'est pas une date valide"
     * )
     * @Assert\NotBlank(
     *     message="La date est requise"
     * )
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var Datetime
     * @Assert\DateTime(
     *     message="{{ value }} n'est pas une date valide"
     * )
     * @Assert\NotBlank(
     *     message="La date est requise"
     * )
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="L'adresse est requise"
     * )
     * @Assert\Length(
     *     max="100",
     *     maxMessage="L'adresse doit faire au maximum {{ limit }} caractères",
     *     normalizer="trim"
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
     * @var string
     * @Assert\NotBlank(
     *     message="La ville est requise"
     * )
     * @Assert\Length(
     *     max="50",
     *     maxMessage="La ville doit faire au maximum {{ limit }} caractères",
     *     normalizer="trim"
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
     * @var string
     * @Assert\NotBlank(
     *     message="Le prénom est requis"
     * )
     * @Assert\Length(
     *     max="50",
     *     min="3",
     *     maxMessage="Le prénom doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le prénom doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un prénom valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Le nom est requis"
     * )
     * @Assert\Length(
     *     max="50",
     *     min="3",
     *     maxMessage="Le nom doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le nom doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un nom valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastname;

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
     * @var Ct404Commercial
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Commercial", inversedBy="professionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404User", inversedBy="professionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommercial(): ?Ct404Commercial
    {
        return $this->commercial;
    }

    public function setCommercial(?Ct404Commercial $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getCompanyEmail(): string
    {
        return $this->companyEmail;
    }

    public function setCompanyEmail(string $companyEmail): void
    {
        $this->companyEmail = $companyEmail;
    }

    public function getUser(): ?Ct404User
    {
        return $this->user;
    }

    public function setUser(?Ct404User $user): self
    {
        $this->user = $user;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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
}
