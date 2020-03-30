<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404Role.
 *
 * @ORM\Table(name="ct404_role")
 * @ORM\Entity
 */
class Ct404Role
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
     * @ORM\Column(name="role_name", type="string", length=50, nullable=false)
     */
    private $roleName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }
}
