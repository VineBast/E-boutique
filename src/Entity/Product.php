<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $NumProduct;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $PriceHT;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $Available;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="NumProduct")
     */
    private $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() :string
    {
        return $this->getNumProduct();
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

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPriceHT(): ?string
    {
        return $this->PriceHT;
    }

    public function setPriceHT(string $PriceHT): self
    {
        $this->PriceHT = $PriceHT;

        return $this;
    }

    public function getAvailable(): ?string
    {
        return $this->Available;
    }

    public function setAvailable(string $Available): self
    {
        $this->Available = $Available;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(?string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * @return String
     */
    public function getMedia(): String
    {
        return $this->media->first()->getPath();
    }

    /**
     * @return String
     */
    public function getAltMedia() : String
    {
        return $this->media->first()->getAlt();
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setName($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getNumProduct() === $this) {
                $medium->setNumProduct(null);
            }
        }

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

}
