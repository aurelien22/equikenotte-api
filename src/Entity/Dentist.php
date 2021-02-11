<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\DentistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource(
 *     itemOperations={"GET", "PUT", "PATCH", "DELETE",
 *          "GET_HORSES"={
 *              "method"="get",
 *              "path"="/dentists/{id}/horses",
 *              "controller"="App\Controller\CustomersHorsesOfConnectDentist",
 *          },
 *          "GET_ACTS"={
 *              "method"="get",
 *              "path"="/dentists/{id}/acts",
 *              "controller"="App\Controller\ActsOfConnectDentist"
 *          }
 *     },
 * )
 * @ORM\Entity(repositoryClass=DentistRepository::class)
 */
class Dentist extends User implements UserInterface
{
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tradename;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Customer::class, mappedBy="dentist")
     * @ApiSubresource
     */
    private $Customers;

    public function __construct()
    {
        $this->Customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTradename()
    {
        return $this->tradename;
    }

    /**
     * @param mixed $tradename
     */
    public function setTradename($tradename): void
    {
        $this->tradename = $tradename;
    }

    /**
     * @return mixed
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param mixed $siret
     */
    public function setSiret($siret): void
    {
        $this->siret = $siret;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->Customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->Customers->contains($customer)) {
            $this->Customers[] = $customer;
            $customer->setDentist($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->Customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getDentist() === $this) {
                $customer->setDentist(null);
            }
        }

        return $this;
    }
}
