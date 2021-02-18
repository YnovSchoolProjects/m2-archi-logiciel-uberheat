<?php


namespace App\Service\ProductConfigurationImport\Builder;


use App\Entity\ProductConfiguration\ProductConfiguration;

interface Builder
{
    public function stepGenericAttributes(array $product);
    public function stepSpecificAttributes(array $product);

    public function getProductConfiguration(): ProductConfiguration;

    public function reset(): void;
}
