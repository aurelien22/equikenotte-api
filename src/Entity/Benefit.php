<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BenefitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BenefitRepository::class)
 */
class Benefit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"acts_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"acts_read"})
     */
    private $designation;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $priceWithoutTax;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $taxRate;

    /**
     * @ORM\ManyToMany(targetEntity=Act::class, inversedBy="benefits")
     */
    private $act;

    public function __construct()
    {
        $this->act = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPriceWithoutTax(): ?string
    {
        return $this->priceWithoutTax;
    }

    public function setPriceWithoutTax(string $priceWithoutTax): self
    {
        $this->priceWithoutTax = $priceWithoutTax;

        return $this;
    }

    public function getTaxRate(): ?string
    {
        return $this->taxRate;
    }

    public function setTaxRate(string $taxRate): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * @return Collection|Act[]
     */
    public function getAct(): Collection
    {
        return $this->act;
    }

    public function addAct(Act $act): self
    {
        if (!$this->act->contains($act)) {
            $this->act[] = $act;
        }

        return $this;
    }

    public function removeAct(Act $act): self
    {
        $this->act->removeElement($act);

        return $this;
    }
}
