<?php

namespace App\Entity;

use App\Repository\ArrivalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArrivalRepository::class)]
class Arrival
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $closed_at = null;

    #[ORM\Column(nullable: true)]
    private ?bool $closed = null;

    #[ORM\OneToMany(mappedBy: 'arrival', targetEntity: ArrivalDetails::class, orphanRemoval: true)]
    private Collection $arrivalDetails;

    public function __construct()
    {
        $this->arrivalDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeImmutable
    {
        return $this->closed_at;
    }

    public function setClosedAt(?\DateTimeImmutable $closed_at): self
    {
        $this->closed_at = $closed_at;

        return $this;
    }

    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(?bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return Collection<int, ArrivalDetails>
     */
    public function getArrivalDetails(): Collection
    {
        return $this->arrivalDetails;
    }

    public function addArrivalDetail(ArrivalDetails $arrivalDetail): self
    {
        if (!$this->arrivalDetails->contains($arrivalDetail)) {
            $this->arrivalDetails->add($arrivalDetail);
            $arrivalDetail->setArrival($this);
        }

        return $this;
    }

    public function removeArrivalDetail(ArrivalDetails $arrivalDetail): self
    {
        if ($this->arrivalDetails->removeElement($arrivalDetail)) {
            // set the owning side to null (unless already changed)
            if ($arrivalDetail->getArrival() === $this) {
                $arrivalDetail->setArrival(null);
            }
        }

        return $this;
    }
}
