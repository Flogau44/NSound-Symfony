<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PartnerCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerCategoriesRepository::class)]
#[ApiResource]
#[GetCollection()]
class PartnerCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Partners>
     */
    #[ORM\OneToMany(targetEntity: Partners::class, mappedBy: 'type')]
    private Collection $partners;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    // Méthode magique pour retourner le type de catégorie de partenaire
    public function __toString()
    {
        return $this->type;
    }

    // Constructeur pour initialiser la collection de partenaires
    public function __construct()
    {
        $this->partners = new ArrayCollection();
    }

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour le type de catégorie de partenaire
    public function getType(): ?string
    {
        return $this->type;
    }

    // Setter pour le type de catégorie de partenaire
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Partners>
     */
    // Getter pour les partenaires
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    // Ajouter un partenaire
    public function addPartner(Partners $partner): static
    {
        if (!$this->partners->contains($partner)) {
            $this->partners->add($partner);
            $partner->setType($this);
        }

        return $this;
    }

    // Supprimer un partenaire
    public function removePartner(Partners $partner): static
    {
        if ($this->partners->removeElement($partner)) {
            // Définir le côté propriétaire à null (sauf si déjà changé)
            if ($partner->getType() === $this) {
                $partner->setType(null);
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
