<?php


namespace App\Service\ProductConfigurationImport\Builder;


use App\Entity\ProductConfiguration\ProductConfiguration;

class BuilderDirector
{
    private ?Builder $builder = null;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function make(array $productConfigurationData): ?ProductConfiguration
    {
        $this->builder->reset();
        $this->builder->stepGenericAttributes($productConfigurationData);
        $this->builder->stepSpecificAttributes($productConfigurationData);

        return $this->builder->getProductConfiguration();
    }
}
