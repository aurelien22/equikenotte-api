<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HorseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"horses_read"}}
 * )
 * @ORM\Entity(repositoryClass=HorseRepository::class)
 */
class Horse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"horses_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9)
     * @Groups({"horses_read"})
     */
    private $sire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"horses_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     * @Groups({"horses_read"})
     */
    private $dateOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity=customer::class, inversedBy="horses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"horses_read"})
     */
    private customer $owner;

    /**
     * @ORM\OneToMany(targetEntity=Act::class, mappedBy="horse", orphanRemoval=true)
     * @Groups({"horses_read"})
     */
    private $acts;

    public function __construct()
    {
        $this->acts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSire(): ?string
    {
        return $this->sire;
    }

    public function setSire(string $sire): self
    {
        $this->sire = $sire;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getOwner(): customer
    {
        return $this->owner;
    }

    public function setOwner(customer $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Act[]
     */
    public function getActs(): Collection
    {
        return $this->acts;
    }

    public function addAct(Act $act): self
    {
        if (!$this->acts->contains($act)) {
            $this->acts[] = $act;
            $act->setHorse($this);
        }

        return $this;
    }

    public function removeAct(Act $act): self
    {
        if ($this->acts->removeElement($act)) {
            // set the owning side to null (unless already changed)
            if ($act->getHorse() === $this) {
                $act->setHorse(null);
            }
        }

        return $this;
    }
}
