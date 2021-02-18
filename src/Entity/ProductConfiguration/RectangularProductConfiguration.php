<?php

namespace App\Entity\ProductConfiguration;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CircularProductConfigurationRepository;
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

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return RectangularProductConfiguration
     */
    public function setWidth(int $width): RectangularProductConfiguration
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return RectangularProductConfiguration
     */
    public function setHeight(int $height): RectangularProductConfiguration
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getThickness(): int
    {
        return $this->thickness;
    }

    /**
     * @param int $thickness
     * @return RectangularProductConfiguration
     */
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
