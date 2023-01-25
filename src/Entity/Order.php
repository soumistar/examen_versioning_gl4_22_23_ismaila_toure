<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?int $coupon_id = null;

    #[ORM\ManyToOne(inversedBy: 'created_at')]
    private ?Customer $customer_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: OrdersDeltails::class)]
    private Collection $ordersDeltails;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: Delivery::class)]
    private Collection $deliveries;

    public function __construct()
    {
        $this->ordersDeltails = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCouponId(): ?int
    {
        return $this->coupon_id;
    }

    public function setCouponId(int $coupon_id): self
    {
        $this->coupon_id = $coupon_id;

        return $this;
    }

    public function getCustomerId(): ?Customer
    {
        return $this->customer_id;
    }

    public function setCustomerId(?Customer $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, OrdersDeltails>
     */
    public function getOrdersDeltails(): Collection
    {
        return $this->ordersDeltails;
    }

    public function addOrdersDeltail(OrdersDeltails $ordersDeltail): self
    {
        if (!$this->ordersDeltails->contains($ordersDeltail)) {
            $this->ordersDeltails->add($ordersDeltail);
            $ordersDeltail->setOrderId($this);
        }

        return $this;
    }

    public function removeOrdersDeltail(OrdersDeltails $ordersDeltail): self
    {
        if ($this->ordersDeltails->removeElement($ordersDeltail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDeltail->getOrderId() === $this) {
                $ordersDeltail->setOrderId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Delivery>
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries->add($delivery);
            $delivery->setOrderId($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getOrderId() === $this) {
                $delivery->setOrderId(null);
            }
        }

        return $this;
    }
}
