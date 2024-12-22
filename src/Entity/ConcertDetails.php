<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ConcertDetailsRepository;

#[ORM\Entity(repositoryClass: ConcertDetailsRepository::class)]
#[ApiResource]
#[GetCollection]
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
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: 'boolean')]
    private bool $publish = false;

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour l'artiste
    public function getArtist(): ?Artists
    {
        return $this->artist;
    }

    // Setter pour l'artiste
    public function setArtist(?Artists $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    // Getter pour la scène
    public function getScene(): ?Scenes
    {
        return $this->scene;
    }

    // Setter pour la scène
    public function setScene(?Scenes $scene): static
    {
        $this->scene = $scene;

        return $this;
    }

    // Getter pour la date
    public function getDate(): ?Dates
    {
        return $this->date;
    }

    // Setter pour la date
    public function setDate(?Dates $date): static
    {
        $this->date = $date;

        return $this;
    }

    // Getter pour l'horaire
    public function getSchedule(): ?Schedules
    {
        return $this->schedule;
    }

    // Setter pour l'horaire
    public function setSchedule(?Schedules $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    // Getter pour la date de création
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    // Setter pour la date de création
    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    // Getter pour la publication
    public function getPublish(): bool
    {
        return $this->publish;
    }

    // Setter pour la publication
    public function setPublish(bool $publish): static
    {
        $this->publish = $publish;

        return $this;
    }
}
