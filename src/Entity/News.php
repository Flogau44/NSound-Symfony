<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[ApiResource]
#[GetCollection]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'news')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NewsCategories $type = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: 'boolean')]
    private bool $publish = false;

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour le type de news
    public function getType(): ?NewsCategories
    {
        return $this->type;
    }

    // Setter pour le type de news
    public function setType(?NewsCategories $type): static
    {
        $this->type = $type;

        return $this;
    }

    // Getter pour le titre
    public function getTitle(): ?string
    {
        return $this->title;
    }

    // Setter pour le titre
    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    // Getter pour l'image
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    // Setter pour l'image
    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

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
