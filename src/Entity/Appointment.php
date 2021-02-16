<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"appointments_read"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"date"})
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"appointments_read"})
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @Groups({"appointments_read"})
     */
    private $startTime;

    /**
     * @ORM\Column(type="time")
     * @Groups({"appointments_read"})
     */
    private $endTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"appointments_read"})
     */
    private $numberOfHorses;

    /**
     * @ORM\ManyToOne(targetEntity=Dentist::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dentist;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="appointments")
     * @Groups({"appointments_read"})
     */
    private $customer;

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

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getNumberOfHorses(): ?int
    {
        return $this->numberOfHorses;
    }

    public function setNumberOfHorses(?int $numberOfHorses): self
    {
        $this->numberOfHorses = $numberOfHorses;

        return $this;
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
