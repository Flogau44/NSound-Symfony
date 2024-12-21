<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PolygonsRepository;
use ApiPlatform\Metadata\GetCollection;

// Déclare une nouvelle classe avec ses annotations pour la gestion ORM et API
#[ORM\Entity(repositoryClass: PolygonsRepository::class)]
#[ApiResource]
#[GetCollection]
class Polygons
{
    // Déclare la propriété $id comme clé primaire avec génération automatique
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Déclare la propriété $coordinates comme un tableau
    #[ORM\Column]
    private array $coordinates = [];

    // Déclare la propriété $colors comme une chaîne de caractères de longueur maximale 255
    #[ORM\Column(length: 255)]
    private ?string $colors = null;

    // Méthode pour obtenir l'identifiant du polygone
    public function getId(): ?int
    {
        return $this->id;
    }

    // Méthode pour obtenir les coordonnées du polygone
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    // Méthode pour définir les coordonnées du polygone
    public function setCoordinates(array $coordinates): static
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    // Méthode pour obtenir les couleurs du polygone
    public function getColors(): ?string
    {
        return $this->colors;
    }

    // Méthode pour définir les couleurs du polygone
    public function setColors(string $colors): static
    {
        $this->colors = $colors;

        return $this;
    }
}
