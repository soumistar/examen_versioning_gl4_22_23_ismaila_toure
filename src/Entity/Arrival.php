<?php

namespace App\Entity;

use App\Repository\ArrivalRepository;
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
    private ?bool $is_closed = null;

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

    public function isIsClosed(): ?bool
    {
        return $this->is_closed;
    }

    public function setIsClosed(?bool $is_closed): self
    {
        $this->is_closed = $is_closed;

        return $this;
    }
}
