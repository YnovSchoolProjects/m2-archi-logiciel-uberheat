<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use App\Entity\ProductConfiguration\ProductConfiguration;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $basePrice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductConfiguration\ProductConfiguration", mappedBy="product")
     */
    private Collection $configurations;

    public function __construct()
    {
        $this->configurations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): self
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    /**
     * @return Collection<ProductConfiguration>
     */
    public function getConfigurations(): Collection
    {
        return $this->configurations;
    }

    public function addConfiguration(ProductConfiguration $configuration): self
    {
        if (!$this->configurations->contains($configuration)) {
            $this->configurations->add($configuration);
            $configuration->setProduct($this);
        }
        return $this;
    }

    public function removeConfiguration(ProductConfiguration $configuration): self
    {
        if ($this->configurations->contains($configuration)) {
            $this->configurations->remove($configuration);
            $configuration->setProduct(null);
        }
        return $this;
    }
}
