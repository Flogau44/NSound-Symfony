<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MarkersRepository;
use ApiPlatform\Metadata\GetCollection;

// Déclare une nouvelle classe avec ses annotations pour la gestion ORM et API
#[ORM\Entity(repositoryClass: MarkersRepository::class)]
#[ApiResource]
#[GetCollection]
class Markers
{
    // Déclare la propriété $id comme clé primaire avec génération automatique
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Déclare la propriété $title comme une chaîne de caractères de longueur maximale 255
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    // Déclare la propriété $latitude comme un float
    #[ORM\Column]
    private ?float $latitude = null;

    // Déclare la propriété $longitude comme un float
    #[ORM\Column]
    private ?float $longitude = null;

    // Déclare la propriété $popup comme une chaîne de caractères de longueur maximale 255
    #[ORM\Column(length: 255)]
    private ?string $popup = null;

    // Déclare la propriété $iconUrl comme une chaîne de caractères de longueur maximale 255
    #[ORM\Column(length: 255)]
    private ?string $iconUrl = null;

    // Méthode pour obtenir l'identifiant du marker
    public function getId(): ?int
    {
        return $this->id;
    }

    // Méthode pour obtenir le titre du marker
    public function getTitle(): ?string
    {
        return $this->title;
    }

    // Méthode pour définir le titre du marker
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    // Méthode pour obtenir la latitude du marker
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    // Méthode pour définir la latitude du marker
    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    // Méthode pour obtenir la longitude du marker
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    // Méthode pour définir la longitude du marker
    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    // Méthode pour obtenir le popup du marker
    public function getPopup(): ?string
    {
        return $this->popup;
    }

    // Méthode pour définir le popup du marker
    public function setPopup(string $popup): static
    {
        $this->popup = $popup;

        return $this;
    }

    // Méthode pour obtenir l'URL de l'icône du marker
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    // Méthode pour définir l'URL de l'icône du marker
    public function setIconUrl(string $iconUrl): static
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }
}
