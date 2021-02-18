<?php


namespace App\Service\ProductConfigurationImport\Builder;


use App\Entity\ProductConfiguration\CircularProductConfiguration;
use App\Entity\ProductConfiguration\ProductConfiguration;

class CircularBuilder implements Builder
{
    public const DISCRIMINATOR = "Circulaire";

    private CircularProductConfiguration $productState;

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
        $this->productState->setDiameter(intval($product['Diametre']));
    }

    public function getProductConfiguration(): ProductConfiguration
    {
        return $this->productState;
    }

    public function reset(): void
    {
        $this->productState = new CircularProductConfiguration();
    }
}
