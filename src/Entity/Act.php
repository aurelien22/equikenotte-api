<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ActRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ActRepository::class)
 */
class Act
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"horses_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"horses_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $billed;

    /**
     * @ORM\ManyToOne(targetEntity=horse::class, inversedBy="acts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $horse;

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
}
