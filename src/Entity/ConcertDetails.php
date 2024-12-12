<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConcertDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertDetailsRepository::class)]
#[ApiResource]
class ConcertDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Artists $artist = null;

    #[ORM\ManyToOne(inversedBy: 'concertDetails')]
    private ?Scenes $scene = null;

    #[ORM\ManyToOne(inversedBy: 'concertDetails')]
    private ?Dates $date = null;

    #[ORM\ManyToOne(inversedBy: 'concertDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Schedules $schedule = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: 'boolean')]
    private bool $publish = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artists
    {
        return $this->artist;
    }

    public function setArtist(?Artists $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    public function getScene(): ?Scenes
    {
        return $this->scene;
    }

    public function setScene(?Scenes $scene): static
    {
        $this->scene = $scene;

        return $this;
    }

    public function getDate(): ?Dates
    {
        return $this->date;
    }

    public function setDate(?Dates $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSchedule(): ?Schedules
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedules $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getpublish(): bool
    {
        return $this->publish;
    }

    public function setpublish(bool $publish): static
    {
        $this->publish = $publish;

        return $this;
    }
}
