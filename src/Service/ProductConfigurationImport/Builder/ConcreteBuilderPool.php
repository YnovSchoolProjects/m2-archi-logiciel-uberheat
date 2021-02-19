<?php


namespace App\Service\ProductConfigurationImport\Builder;


class ConcreteBuilderPool
{
    private array $pool = [];

    public function get(string $class): Builder
    {
        if (!array_key_exists($class, $this->pool)) {
            $this->pool[$class] = new $class();
        }
        return $this->pool[$class];
    }
}
