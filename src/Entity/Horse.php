<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HorseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=HorseRepository::class)
 */
class Horse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $sire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity=customer::class, inversedBy="horses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Owner;

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

    public function getOwner(): ?customer
    {
        return $this->Owner;
    }

    public function setOwner(?customer $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }
}
