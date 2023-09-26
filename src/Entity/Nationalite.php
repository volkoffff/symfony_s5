<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NationaliteRepository::class)]
#[ApiResource()]
class Nationalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['actor:read'])]
    private ?string $nationalite = null;

    #[ORM\OneToMany(mappedBy: 'nationalite', targetEntity: Actor::class)]
    private Collection $actor;

    public function __construct()
    {
        $this->actor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actor->contains($actor)) {
            $this->actor->add($actor);
            $actor->setNationalite($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actor->removeElement($actor)) {
            // set the owning side to null (unless already changed)
            if ($actor->getNationalite() === $this) {
                $actor->setNationalite(null);
            }
        }

        return $this;
    }
}
