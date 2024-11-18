<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SchedulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchedulesRepository::class)]
#[ApiResource]
class Schedules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    /**
     * @var Collection<int, ConcertDetails>
     */
    #[ORM\OneToMany(targetEntity: ConcertDetails::class, mappedBy: 'schedule')]
    private Collection $concertDetails;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->concertDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): static
    {
        $this->schedule = $schedule;

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
            $concertDetail->setSchedule($this);
        }

        return $this;
    }

    public function removeConcertDetail(ConcertDetails $concertDetail): static
    {
        if ($this->concertDetails->removeElement($concertDetail)) {
            // set the owning side to null (unless already changed)
            if ($concertDetail->getSchedule() === $this) {
                $concertDetail->setSchedule(null);
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
