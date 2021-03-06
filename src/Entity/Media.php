<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="media")
     */
    private $NumProduct;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $Alt;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumProduct(): ?Product
    {
        return $this->Name;
    }

    public function setNumProduct(?Product $NumProduct): self
    {
        $this->NumProduct = $NumProduct;

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

    public function getAlt(): ?string
    {
        return $this->Alt;
    }

    public function setAlt(?string $Alt): self
    {
        $this->Alt = $Alt;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->Path;
    }

    public function setPath(string $Path): self
    {
        $this->Path = $Path;

        return $this;
    }
}
