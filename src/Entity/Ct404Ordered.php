<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ct404_ordered")
 * @ORM\Entity(repositoryClass="App\Repository\Ct404OrderedRepository")
 */
class Ct404Ordered
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="{{ value }} n'est pas une date valide"
     * )
     * @Assert\NotBlank(
     *     message="La date de commande est requise"
     * )
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $orderDate;

    /**
     * @var DateTime
     * @Assert\DateTime(
     *     message="{{ value }} n'est pas une date valide"
     * )
     * @Assert\NotBlank(
     *     message="La date de livraison est requise"
     * )
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $deliveryDate;

    /**
     * @var float
     * @Assert\NotBlank(
     *     message="Le prix total est requis"
     * )
     * @Assert\Regex(
     *     pattern="/^([\d]{1,9}((\.|\,){1}[\d]{0,2})?)$/",
     *     message="{{ value }} n'est pas un prix valide",
     *     normalizer="trim"
     * )
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $totalPrice;

    /**
     * @var Ct404Commercial
     * @ORM\ManyToOne(targetEntity="App\Entity\Ct404Commercial", inversedBy="commercialOrdereds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commercial;

    /**
     * @var Ct404OrderDetail
     * @ORM\OneToMany(targetEntity="App\Entity\Ct404OrderDetail", mappedBy="cOrder", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderDetail;

    public function __construct()
    {
        $this->orderDetail = new ArrayCollection();
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

    public function getCommercial(): ?Ct404Commercial
    {
        return $this->commercial;
    }

    public function setCommercial(?Ct404Commercial $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getOrderDetail(): Collection
    {
        return $this->orderDetail;
    }

    public function addOrderDetail(Ct404OrderDetail $orderDetail): self
    {
        if (!$this->orderDetail->contains($orderDetail)) {
            $this->orderDetail[] = $orderDetail;
            $orderDetail->setCOrder($this);
        }

        return $this;
    }

    public function removeOrderDetail(Ct404OrderDetail $orderDetail): self
    {
        if ($this->orderDetail->contains($orderDetail)) {
            $this->orderDetail->removeElement($orderDetail);

            if ($orderDetail->getCOrder() === $this) {
                $orderDetail->setCOrder(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
