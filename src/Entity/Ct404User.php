<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ct404UserRepository")
 * @ORM\Table(name="ct404_user")
 * @UniqueEntity(fields={"email"}, message="Cette adresse email est déjà utilisée")
 */
class Ct404User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userToken;

    /**
     * @Assert\Email(
     *     message="Votre adresse email n'est pas valide"
     * )
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    // When new registration, the user has a not valid role, he has to confirm email
    /**
     * @ORM\Column(type="json")
     */
    private $roles = 'ROLE_NOT_VALID';

    /**
     * @var string The hashed password
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404Particular", mappedBy="user", orphanRemoval=true)
     */
    private $particulars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404Professional", mappedBy="user", orphanRemoval=true)
     */
    private $professionals;

    public function __construct()
    {
        $this->particulars = new ArrayCollection();
        $this->professionals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        return [$roles];
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setRolesValid(): self
    {
        // Use this function to validate the user email
        $this->roles = 'ROLE_USER';

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserToken(): ?string
    {
        return $this->userToken;
    }

    public function setUserToken(string $userToken): self
    {
        // In the form, put the Unix time to the hidden input
        // Here, put random key around this time stamp
        $this->userToken = bin2hex(random_bytes(8)).$userToken.bin2hex(random_bytes(8));

        return $this;
    }

    /**
     * @return Collection|Ct404Particular[]
     */
    public function getParticulars(): Collection
    {
        return $this->particulars;
    }

    public function addParticular(Ct404Particular $particular): self
    {
        if (!$this->particulars->contains($particular)) {
            $this->particulars[] = $particular;
            $particular->setUser($this);
        }

        return $this;
    }

    public function removeParticular(Ct404Particular $particular): self
    {
        if ($this->particulars->contains($particular)) {
            $this->particulars->removeElement($particular);
            // set the owning side to null (unless already changed)
            if ($particular->getUser() === $this) {
                $particular->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ct404Professional[]
     */
    public function getProfessionals(): Collection
    {
        return $this->professionals;
    }

    public function addProfessional(Ct404Professional $professional): self
    {
        if (!$this->professionals->contains($professional)) {
            $this->professionals[] = $professional;
            $professional->setUser($this);
        }

        return $this;
    }

    public function removeProfessional(Ct404Professional $professional): self
    {
        if ($this->professionals->contains($professional)) {
            $this->professionals->removeElement($professional);
            // set the owning side to null (unless already changed)
            if ($professional->getUser() === $this) {
                $professional->setUser(null);
            }
        }

        return $this;
    }
}
