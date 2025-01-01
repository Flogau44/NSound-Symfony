<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArtistsRepository;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ArtistsRepository::class)]
#[ApiResource]
#[GetCollection]
class Artists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    /**
     * @var Collection<int, Genres>
     */
    #[ORM\ManyToMany(targetEntity: Genres::class, inversedBy: 'artists')]
    private Collection $genres;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $video = null;

    // Méthode magique pour retourner le nom de l'artiste
    public function __toString()
    {
        return $this->name;
    }

    // Constructeur pour initialiser la collection de genres
    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour le nom
    public function getName(): ?string
    {
        return $this->name;
    }

    // Setter pour le nom
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Getter pour l'image
    public function getPicture()
    {
        return $this->picture;
    }

    // Setter pour l'image
    public function setPicture($picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    // Getter pour le contenu
    public function getContent(): ?string
    {
        return $this->content;
    }

    // Setter pour le contenu
    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    // Getter pour l'URL
    public function getUrl(): ?string
    {
        return $this->url;
    }

    // Setter pour l'URL
    public function setUrl(?string $url): static
    {
        $this->url = $url;

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

    /**
     * @return Collection<int, Genres>
     */
    // Getter pour les genres
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    // Ajouter un genre
    public function addGenre(Genres $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    // Supprimer un genre
    public function removeGenre(Genres $genre): static
    {
        $this->genres->removeElement($genre);

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

    // Getter pour la vidéo
    public function getVideo(): ?string
    {
        return $this->video;
    }

    // Setter pour la vidéo
    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    // Méthode pour obtenir les noms des genres en une chaîne de caractères
    public function getGenreNames(): string
    {
        $genreNames = array_map(function ($genre) {
            return $genre->getGenre();
        }, $this->genres->toArray());

        return implode(', ', $genreNames);
    }
}
