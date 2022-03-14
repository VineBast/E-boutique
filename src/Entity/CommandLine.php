<?php

namespace App\Entity;

use App\Repository\CommandLineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandLineRepository::class)
 */
class CommandLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OrderNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NumProduct;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Quantity;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?Order
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(?Order $OrderNumber): self
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    public function getNumProduct(): ?string
    {
        return $this->NumProduct;
    }

    public function setNumProduct(?Product $NumProduct): self
    {
        $this->NumProduct = $NumProduct;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(string $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
