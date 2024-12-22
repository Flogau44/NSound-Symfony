<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartnersRepository;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: PartnersRepository::class)]
#[ApiResource]
#[GetCollection]
class Partners
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'partners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PartnerCategories $type = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: 'boolean')]
    private bool $publish = false;

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

    // Getter pour l'URL
    public function getUrl(): ?string
    {
        return $this->url;
    }

    // Setter pour l'URL
    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    // Getter pour le logo
    public function getLogo()
    {
        return $this->logo;
    }

    // Setter pour le logo
    public function setLogo($logo): static
    {
        $this->logo = $logo;

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

    // Getter pour le type de partenaire
    public function getType(): ?PartnerCategories
    {
        return $this->type;
    }

    // Setter pour le type de partenaire
    public function setType(?PartnerCategories $type): static
    {
        $this->type = $type;

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
