<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?House $house = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'relation')]
    private ?self $couple = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'couple')]
    private Collection $relation;

    /**
     * @var Collection<int, Cat>
     */
    #[ORM\ManyToMany(targetEntity: Cat::class, inversedBy: 'users')]
    private Collection $cats;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->cats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): static
    {
        $this->house = $house;

        return $this;
    }

    public function getCouple(): ?self
    {
        return $this->couple;
    }

    public function setCouple(?self $couple): static
    {
        $this->couple = $couple;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(self $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setCouple($this);
        }

        return $this;
    }

    public function removeRelation(self $relation): static
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getCouple() === $this) {
                $relation->setCouple(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cat>
     */
    public function getCats(): Collection
    {
        return $this->cats;
    }

    public function addCat(Cat $cat): static
    {
        if (!$this->cats->contains($cat)) {
            $this->cats->add($cat);
        }

        return $this;
    }

    public function removeCat(Cat $cat): static
    {
        $this->cats->removeElement($cat);

        return $this;
    }
}
