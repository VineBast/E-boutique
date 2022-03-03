<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $OrderNumber;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $Valid;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateTime;

    /**
     * @ORM\OneToMany(targetEntity=CommandLine::class, mappedBy="OrderNumber")
     */
    private $commandLines;

    public function __construct()
    {
        $this->commandLines = new ArrayCollection();
    }

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

    public function getOrderNumber(): ?string
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(string $OrderNumber): self
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    public function getValid(): ?string
    {
        return $this->Valid;
    }

    public function setValid(string $Valid): self
    {
        $this->Valid = $Valid;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->DateTime;
    }

    public function setDateTime(?\DateTimeInterface $DateTime): self
    {
        $this->DateTime = $DateTime;

        return $this;
    }

    /**
     * @return Collection<int, CommandLine>
     */
    public function getCommandLines(): Collection
    {
        return $this->commandLines;
    }

    public function addCommandLine(CommandLine $commandLine): self
    {
        if (!$this->commandLines->contains($commandLine)) {
            $this->commandLines[] = $commandLine;
            $commandLine->setOrderNumber($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getOrderNumber() === $this) {
                $commandLine->setOrderNumber(null);
            }
        }

        return $this;
    }
}
