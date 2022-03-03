<?php

namespace App\Entity;

use App\Repository\CustomerAddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerAddressRepository::class)
 */
class CustomerAddress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="customerAddresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Cp;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?User
    {
        return $this->Email;
    }

    public function setEmail(?User $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->Cp;
    }

    public function setCp(string $Cp): self
    {
        $this->Cp = $Cp;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }
}
