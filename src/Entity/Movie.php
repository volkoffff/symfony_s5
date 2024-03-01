<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Odm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['movie:read'],
    ]
)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movie:read', 'category:read', 'actor:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[Groups(['movie:read'])]
    #[Assert\NotBlank(message: 'Le film doit être forcément relié à une cathégorie')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'movies')]
    #[Groups(['movie:read'])]
    private Collection $actors;

    #[ORM\Column(length: 255)]
    #[Groups(['movie:read', 'actor:read', 'category:read'])]
    #[Assert\NotBlank(message: 'Le titre ne doît pas être vide')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $title = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['movie:read'])]
    #[Assert\NotBlank(message: 'La description ne doît pas être vide')]
    #[Assert\Length(min: 10, minMessage:'la derscription doit être plus précise(plus longue)')]
    private ?string $description = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['movie:read'])]
    #[ApiFilter(RangeFilter::class)]
    #[Assert\NotBlank(message: 'La durée ne doît pas être vide')]
    #[Assert\Positive(message:'la durée doit être positive')]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'La date ne doît pas être vide')]
    #[Groups(['movie:read'])]
    private ?\DateTimeInterface $releaseDate = null;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        $this->actors->removeElement($actor);

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }
}
