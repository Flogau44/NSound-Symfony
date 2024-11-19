<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:news']],
    denormalizationContext: ['groups' => ['write:news']]
)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:news'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:news', 'write:news'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read:news', 'write:news'])]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:news', 'write:news'])]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read:news', 'write:news'])]
    private ?string $url = null;

    #[ORM\Column]
    #[Groups(['read:news'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:news'])]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
