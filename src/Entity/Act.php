<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ActRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"acts_read"}}
 * )
 * @ORM\Entity(repositoryClass=ActRepository::class)
 */
class Act
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"horses_read", "acts_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"horses_read", "acts_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"acts_read"})
     */
    private $billed;

    /**
     * @ORM\ManyToOne(targetEntity=horse::class, inversedBy="acts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"acts_read"})
     */
    private $horse;

    /**
     * @ORM\ManyToMany(targetEntity=Benefit::class, mappedBy="act")
     * @Groups({"acts_read"})
     */
    private $benefits;

    public function __construct()
    {
        $this->benefits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBilled(): ?bool
    {
        return $this->billed;
    }

    public function setBilled(bool $billed): self
    {
        $this->billed = $billed;

        return $this;
    }

    public function getHorse(): ?horse
    {
        return $this->horse;
    }

    public function setHorse(?horse $horse): self
    {
        $this->horse = $horse;

        return $this;
    }

    /**
     * @return Collection|Benefit[]
     */
    public function getBenefits(): Collection
    {
        return $this->benefits;
    }

    public function addBenefit(Benefit $benefit): self
    {
        if (!$this->benefits->contains($benefit)) {
            $this->benefits[] = $benefit;
            $benefit->addAct($this);
        }

        return $this;
    }

    public function removeBenefit(Benefit $benefit): self
    {
        if ($this->benefits->removeElement($benefit)) {
            $benefit->removeAct($this);
        }

        return $this;
    }
}
