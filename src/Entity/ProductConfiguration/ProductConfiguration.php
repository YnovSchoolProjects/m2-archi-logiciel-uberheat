<?php

namespace App\Entity\ProductConfiguration;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;

/**
 * @ApiResource()
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"circular" = "CircularProductConfiguration", "rectangular" = "RectangularProductConfiguration"})
 */
abstract class ProductConfiguration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $depth;

    /**
     * @ORM\Column(type="float")
     */
    private $db1;

    /**
     * @ORM\Column(type="float")
     */
    private $db2;

    /**
     * @ORM\Column(type="float")
     */
    private $db5;

    /**
     * @ORM\Column(type="float")
     */
    private $db10;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="configurations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private ?Product $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepth(): ?int
    {
        return $this->depth;
    }

    public function setDepth(int $depth): self
    {
        $this->depth = $depth;

        return $this;
    }

    public function getDb1(): ?float
    {
        return $this->db1;
    }

    public function setDb1(float $db1): self
    {
        $this->db1 = $db1;

        return $this;
    }

    public function getDb2(): ?float
    {
        return $this->db2;
    }

    public function setDb2(float $db2): self
    {
        $this->db2 = $db2;

        return $this;
    }

    public function getDb5(): ?float
    {
        return $this->db5;
    }

    public function setDb5(float $db5): self
    {
        $this->db5 = $db5;

        return $this;
    }

    public function getDb10(): ?float
    {
        return $this->db10;
    }

    public function setDb10(float $db10): self
    {
        $this->db10 = $db10;

        return $this;
    }

    public abstract function getSurface(): float;

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $product->addConfiguration($this);
        $this->product = $product;
        return $this;
    }
}
