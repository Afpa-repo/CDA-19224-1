<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_commercial")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404CommercialRepository")
 */
class Ct404Commercial
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
     * @Assert\Length(
     *     max="50",
     *     min="30",
     *     maxMessage="Le prénom doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le prénom doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\NotBlank(
     *     message="Le prénom est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\-éèêëûüùîïíôöœàáâæ]+$/i",
     *     message="{{ value }} n'est pas un prénom valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Length(
     *     max="50",
     *     min="30",
     *     maxMessage="Le nom doit faire au maximum {{ limit }} caractères",
     *     minMessage="Le nom doit faire au minimum {{ limit }} caractères",
     *     normalizer="trim"
     * )
     * @Assert\NotBlank(
     *     message="Le nom est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^[\w\-éèêëûüùîïíôöœàáâæ]+$/i",
     *     message="{{ value }} n'est pas un nom valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var bool
     * @Assert\NotBlank(
     *     allowNull=false,
     *     message="Vous devez donner une réponse"
     * )
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $commercialForIndividual;

    /**
     * @var bool
     * @Assert\NotBlank(
     *     allowNull=false,
     *     message="Vous devez donner une réponse"
     * )
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $commercialForProfessional;

    /**
     * @var Ct404Ordered
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404Ordered", mappedBy="commercial")
     */
    private $commercialOrdereds;

    public function __construct()
    {
        $this->commercialOrdereds = new ArrayCollection();
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

    public function getCommercialForIndividual(): ?bool
    {
        return $this->commercialForIndividual;
    }

    public function setCommercialForIndividual(bool $commercialForIndividual): self
    {
        $this->commercialForIndividual = $commercialForIndividual;

        return $this;
    }

    public function getCommercialForProfessional(): ?bool
    {
        return $this->commercialForProfessional;
    }

    public function setCommercialForProfessional(bool $commercialForProfessional): self
    {
        $this->commercialForProfessional = $commercialForProfessional;

        return $this;
    }

    public function getCommercialOrdereds(): Collection
    {
        return $this->commercialOrdereds;
    }

    public function addCommercialOrdered(Ct404Ordered $commercialOrdered): self
    {
        if (!$this->commercialOrdereds->contains($commercialOrdered)) {
            $this->commercialOrdereds[] = $commercialOrdered;
            $commercialOrdered->setCommercial($this);
        }

        return $this;
    }

    public function removeCommercialOrdered(Ct404Ordered $commercialOrdered): self
    {
        if ($this->commercialOrdereds->contains($commercialOrdered)) {
            $this->commercialOrdereds->removeElement($commercialOrdered);

            if ($commercialOrdered->getCommercial() === $this) {
                $commercialOrdered->setCommercial(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
