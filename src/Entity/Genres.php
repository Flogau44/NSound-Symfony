<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GenresRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
#[ApiResource]
#[GetCollection]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    /**
     * @var Collection<int, Artists>
     */
    #[ORM\ManyToMany(targetEntity: Artists::class, mappedBy: 'genres')]
    private Collection $artists;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // Méthode magique pour retourner le genre
    public function __toString()
    {
        return $this->genre;
    }

    // Constructeur pour initialiser la collection d'artistes
    public function __construct()
    {
        $this->artists = new ArrayCollection();
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour le genre
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    // Setter pour le genre
    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Artists>
     */
    // Getter pour les artistes
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    // Ajouter un artiste
    public function addArtist(Artists $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->addGenre($this);
        }

        return $this;
    }

    // Supprimer un artiste
    public function removeArtist(Artists $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeGenre($this);
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
