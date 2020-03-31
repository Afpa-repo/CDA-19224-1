<?php

/* TODO:
 * Ajouter d'autres Validation
 * Pourquoi Strategy IDENTITY ?
 * Pourquoi il y a des INDEX ?
 * Vérifier que tout est bien là
 * Pourquoi il y a un join dans un join ?
 * Mettre le date default dans un autre fichier ? (index.php)
 * Changer le nom des JOINS
 * */

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

date_default_timezone_set('Europe/Paris');

/**
 * Ct404ordered.
 *
 * @ORM\Table(name="ct404_ordered", indexes={@ORM\Index(name="IDX_7A3226166D7E3993", columns={"id_ct404_commercial_id"})})
 * @ORM\Entity
 */
class Ct404Ordered
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="La date n'est pas valide"
     * )
     * @ORM\Column(name="order_date", type="datetime", nullable=false)
     */
    private $orderDate;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="La date n'est pas valide"
     * )
     * @ORM\Column(name="delivery_date", type="date", nullable=false)
     */
    private $deliveryDate;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^([\d]{1,9}((\.|\,){1}[\d]{0,2})?)$/",
     *     message="Votre prix n'est pas valide"
     * )
     * @ORM\Column(name="total_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $totalPrice;

    /**
     * @var Ct404Commercial
     * @Assert\Positive()
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

    public function getOrderDate(): ?DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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
