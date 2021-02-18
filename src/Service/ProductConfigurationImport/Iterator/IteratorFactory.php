<?php


namespace App\Service\ProductConfigurationImport\Iterator;


class IteratorFactory
{
    private const CSV_TYPE = "csv";

    public function createIterator(string $data, string $type): Iterator
    {
        switch ($type) {
            case self::CSV_TYPE:
                return new CsvIterator($data);
            default:
                throw new \LogicException("Unsupported import type");
        }
    }
}
