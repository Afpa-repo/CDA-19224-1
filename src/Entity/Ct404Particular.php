<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_particular")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404ParticularRepository")
 * @UniqueEntity(
 *     errorPath="email",
 *     fields={"email", "pseudo"},
 *     message="L'email et/ou le pseudo ont déjà été pris"
 * )
 */
class Ct404Particular
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
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="Le pseudo est requis"
     * )
     * @Assert\Length(
     *     max="50",
     *     min="3",
     *     maxMessage="Le pseudo doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le pseudo doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un pseudo valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     * @Assert\NotBlank(
     *     message="La clé est requise"
     * )
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $userKey;

    /**
     * @var bool
     * @Assert\NotBlank(
     *     allowNull=false,
     *     message="Vous devez donner une réponse"
     * )
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $active;

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
     * @var Ct404Commercial
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Commercial", inversedBy="particulars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercial;

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

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
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

    public function getUserKey(): ?string
    {
        return $this->userKey;
    }

    public function setUserKey(string $userKey): self
    {
        $this->userKey = $userKey;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
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
}
