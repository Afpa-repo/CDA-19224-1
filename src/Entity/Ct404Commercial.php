<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404commercial
 *
 * @ORM\Table(name="ct404commercial")
 * @ORM\Entity
 */
class Ct404Commercial
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
     * @Assert\Regex("/^[\w\-éèêëûüùîïíôöœàáâæ]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Regex("/^[\w\-éèêëûüùîïíôöœàáâæ]+$/",
     *     message="Vous utilisez des caractères interdits")
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var bool
     * @Assert\NotNull()
     * @ORM\Column(name="commercial_for_individual", type="boolean", nullable=false)
     */
    private $commercialForIndividual;

    /**
     * @var bool
     * @Assert\NotNull()
     * @ORM\Column(name="commercial_for_professional", type="boolean", nullable=false)
     */
    private $commercialForProfessional;

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


}
