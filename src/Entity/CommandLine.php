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
     * @ORM\Column(type="string", length=40)
     */
    private $NumProduct;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Quantity;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="NumProduct")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="OrderNumber")
     */
    private $media;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->media = new ArrayCollection();
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

    public function setNumProduct(string $NumProduct): self
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setNumProduct($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getNumProduct() === $this) {
                $product->setNumProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setOrderNumber($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getOrderNumber() === $this) {
                $medium->setOrderNumber(null);
            }
        }

        return $this;
    }
}
