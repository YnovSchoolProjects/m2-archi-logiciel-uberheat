<?php


namespace App\Service\ProductConfigurationImport\Builder;


class ConcreteBuilderPool
{
    private array $pool = [];

    public function get(string $class): Builder
    {
        if ($this->pool[$class] === null) {
            $this->pool[$class] = new $class();
        }
        return $this->pool[$class];
    }
}
