<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ct404Category
 *
 * @ORM\Table(name="ct404_category")
 * @ORM\Entity
 */
class Ct404Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    // TODO : On met pas de nom ?
}
