<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\SchedulesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: SchedulesRepository::class)]
#[ApiResource]
#[GetCollection]
class Schedules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    /**
     * @var Collection<int, ConcertDetails>
     */
    #[ORM\OneToMany(targetEntity: ConcertDetails::class, mappedBy: 'schedule')]
    private Collection $concertDetails;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // Méthode magique pour retourner l'horaire
    public function __toString()
    {
        return $this->schedule;
    }

    // Constructeur pour initialiser la collection de détails de concert
    public function __construct()
    {
        $this->concertDetails = new ArrayCollection();
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour l'horaire
    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    // Setter pour l'horaire
    public function setSchedule(string $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return Collection<int, ConcertDetails>
     */
    // Getter pour les détails de concert
    public function getConcertDetails(): Collection
    {
        return $this->concertDetails;
    }

    // Ajouter un détail de concert
    public function addConcertDetail(ConcertDetails $concertDetail): static
    {
        if (!$this->concertDetails->contains($concertDetail)) {
            $this->concertDetails->add($concertDetail);
            $concertDetail->setSchedule($this);
        }

        return $this;
    }

    // Supprimer un détail de concert
    public function removeConcertDetail(ConcertDetails $concertDetail): static
    {
        if ($this->concertDetails->removeElement($concertDetail)) {
            // Définir le côté propriétaire à null (sauf si déjà changé)
            if ($concertDetail->getSchedule() === $this) {
                $concertDetail->setSchedule(null);
            }
        }

        return $this;
    }

    // Getter pour le slug
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    // Setter pour le slug
    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
