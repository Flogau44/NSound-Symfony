<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\NewsCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: NewsCategoriesRepository::class)]
#[ApiResource]
#[GetCollection]
class NewsCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $gravity = null;

    /**
     * @var Collection<int, News>
     */
    #[ORM\OneToMany(targetEntity: News::class, mappedBy: 'type')]
    private Collection $news;

    // Méthode magique pour retourner le type de news
    public function __toString()
    {
        return $this->type;
    }

    // Constructeur pour initialiser la collection de news
    public function __construct()
    {
        $this->news = new ArrayCollection();
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour le type de news
    public function getType(): ?string
    {
        return $this->type;
    }

    // Setter pour le type de news
    public function setType(string $type): static
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

    // Getter pour la gravité
    public function getGravity(): ?string
    {
        return $this->gravity;
    }

    // Setter pour la gravité
    public function setGravity(string $gravity): static
    {
        $this->gravity = $gravity;

        return $this;
    }
    /**
     * @return Collection<int, News>
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    // Ajouter une news
    public function addNews(News $news): static
    {
        if (!$this->news->contains($news)) {
            $this->news->add($news);
            $news->setType($this);
        }

        return $this;
    }

    // Supprimer une news
    public function removeNews(News $news): static
    {
        if ($this->news->removeElement($news)) {
            // Définir le côté propriétaire à null (sauf si déjà changé)
            if ($news->getType() === $this) {
                $news->setType(null);
            }
        }

        return $this;
    }
}
