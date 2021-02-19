<?php

namespace App\Entity\ProductConfiguration;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CircularProductConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CircularProductConfigurationRepository::class)
 */
class CircularProductConfiguration extends ProductConfiguration
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $diameter;

    public function isEqual(ProductConfiguration $productConfiguration): bool {
        return parent::isEqual($productConfiguration) &&
            $productConfiguration instanceof CircularProductConfiguration &&
            $this->diameter === $productConfiguration->diameter;
    }

    public function getDiameter(): int
    {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): CircularProductConfiguration
    {
        $this->diameter = $diameter;
        return $this;
    }

    public function getSurface(): float
    {
        return 2 * pi() * ($this->diameter / 2);
    }
}
