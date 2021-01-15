<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=Dentist::class, inversedBy="Customers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dentist;

    public function getDentist(): ?Dentist
    {
        return $this->dentist;
    }

    public function setDentist(?Dentist $dentist): self
    {
        $this->dentist = $dentist;

        return $this;
    }
}
