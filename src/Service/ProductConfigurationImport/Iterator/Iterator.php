<?php


namespace App\Service\ProductConfigurationImport\Iterator;


interface Iterator
{
    public function next(): void;
    public function current(): array;
    public function hasMore(): bool;
}
