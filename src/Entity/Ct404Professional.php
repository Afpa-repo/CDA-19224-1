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
     * @Assert\NotBlank(
     *     message="Le nom du contact est requis"
     * )
     * @Assert\Length(
     *     max="50",
     *     maxMessage="Le nom du contact doit faire au maximum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\&\'\-éèêëûüùîïíôöœàáâæç]+$/i",
     *     message="{{ value }} n'est pas un nom de contact valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $contact;

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
     * @var Ct404Commercial
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Commercial", inversedBy="professionals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercial;

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

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
}
