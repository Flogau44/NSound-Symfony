<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ScenesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenesRepository::class)]
#[ApiResource]
class Scenes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, ConcertDetails>
     */
    #[ORM\OneToMany(targetEntity: ConcertDetails::class, mappedBy: 'scene')]
    private Collection $concertDetails;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __toString()
    {
    return $this->name;
    }

    public function __construct()
    {
        $this->concertDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ConcertDetails>
     */
    public function getConcertDetails(): Collection
    {
        return $this->concertDetails;
    }

    public function addConcertDetail(ConcertDetails $concertDetail): static
    {
        if (!$this->concertDetails->contains($concertDetail)) {
            $this->concertDetails->add($concertDetail);
            $concertDetail->setScene($this);
        }

        return $this;
    }

    public function removeConcertDetail(ConcertDetails $concertDetail): static
    {
        if ($this->concertDetails->removeElement($concertDetail)) {
            // set the owning side to null (unless already changed)
            if ($concertDetail->getScene() === $this) {
                $concertDetail->setScene(null);
            }
        }

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
