<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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

    /**
     * @ORM\OneToMany(targetEntity=Horse::class, mappedBy="owner")
     */
    private $horses;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="customer")
     */
    private $appointments;

    public function __construct()
    {
        $this->horses = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getDentist(): ?Dentist
    {
        return $this->dentist;
    }

    public function setDentist(?Dentist $dentist): self
    {
        $this->dentist = $dentist;

        return $this;
    }

    /**
     * @return Collection|Horse[]
     */
    public function getHorses(): Collection
    {
        return $this->horses;
    }

    public function addHorse(Horse $horse): self
    {
        if (!$this->horses->contains($horse)) {
            $this->horses[] = $horse;
            $horse->setowner($this);
        }

        return $this;
    }

    public function removeHorse(Horse $horse): self
    {
        if ($this->horses->removeElement($horse)) {
            // set the owning side to null (unless already changed)
            if ($horse->getowner() === $this) {
                $horse->setowner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setCustomer($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getCustomer() === $this) {
                $appointment->setCustomer(null);
            }
        }

        return $this;
    }
}
