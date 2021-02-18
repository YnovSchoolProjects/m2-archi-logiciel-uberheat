<?php


namespace App\Service\ProductConfigurationImport\Builder;


use App\Entity\ProductConfiguration\RectangularProductConfiguration;
use App\Entity\ProductConfiguration\ProductConfiguration;

class RectangularBuilder implements Builder
{
    public const DISCRIMINATOR = "Rectangulaire";

    private RectangularProductConfiguration $productState;

    public function stepGenericAttributes(array $product)
    {
        $this->productState->setDb1(floatval($product['1m']));
        $this->productState->setDb2(floatval($product['2m']));
        $this->productState->setDb5(floatval($product['5m']));
        $this->productState->setDb10(floatval($product['10m']));
        $this->productState->setDepth(intval($product['Profondeur']));
    }

    public function stepSpecificAttributes(array $product)
    {
        $this->productState->setHeight(intval($product['Hauteur']));
        $this->productState->setWidth(intval($product['Largeur']));
        $this->productState->setThickness(intval($product['Epaisseur']));
    }

    public function getProductConfiguration(): ProductConfiguration
    {
        return $this->productState;
    }

    public function reset(): void
    {
        $this->productState = new RectangularProductConfiguration();
    }
}
