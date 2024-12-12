<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DatesRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: DatesRepository::class)]
#[ApiResource]
#[GetCollection]
class Dates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, ConcertDetails>
     */
    #[ORM\OneToMany(targetEntity: ConcertDetails::class, mappedBy: 'date')]
    private Collection $concertDetails;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // Méthode magique pour retourner la date formatée
    public function __toString()
    {
        return $this->date ? $this->date->format('d-m-Y') : '';
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

    // Getter pour la date
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    // Setter pour la date
    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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
            $concertDetail->setDate($this);
        }

        return $this;
    }

    // Supprimer un détail de concert
    public function removeConcertDetail(ConcertDetails $concertDetail): static
    {
        if ($this->concertDetails->removeElement($concertDetail)) {
            // Définir le côté propriétaire à null (sauf si déjà changé)
            if ($concertDetail->getDate() === $this) {
                $concertDetail->setDate(null);
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
