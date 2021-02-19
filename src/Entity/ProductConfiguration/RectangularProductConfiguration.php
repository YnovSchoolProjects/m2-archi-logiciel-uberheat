<?php

namespace App\Entity\ProductConfiguration;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RectangularProductConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RectangularProductConfigurationRepository::class)
 */
class RectangularProductConfiguration extends ProductConfiguration
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $width;

    /**
     * @ORM\Column(type="integer")
     */
    private int $height;

    /**
     * @ORM\Column(type="integer")
     */
    private int $thickness;

    public function isEqual(ProductConfiguration $productConfiguration): bool {
        return parent::isEqual($productConfiguration) &&
            $productConfiguration instanceof RectangularProductConfiguration &&
            $this->width === $productConfiguration->width &&
            $this->height === $productConfiguration->height &&
            $this->thickness === $productConfiguration->thickness;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): RectangularProductConfiguration
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): RectangularProductConfiguration
    {
        $this->height = $height;
        return $this;
    }

    public function getThickness(): int
    {
        return $this->thickness;
    }

    public function setThickness(int $thickness): RectangularProductConfiguration
    {
        $this->thickness = $thickness;
        return $this;
    }

    public function getSurface(): float
    {
        return $this->height * $this->width;
    }
}
