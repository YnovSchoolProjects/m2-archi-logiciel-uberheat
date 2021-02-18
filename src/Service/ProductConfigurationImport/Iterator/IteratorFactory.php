<?php


namespace App\Service\ProductConfigurationImport\Iterator;


class IteratorFactory
{
    private const CSV_TYPE = "csv";

    public function createIterator(string $data, string $type = null): Iterator
    {
        if ($type === null) {
            $type = $this->determineType($data);
        }

        switch ($type) {
            case self::CSV_TYPE:
                return new CsvIterator($data);
            default:
                throw new \LogicException("Unsupported import type");
        }
    }

    private function determineType(string $data): string
    {
        // determine which type format is used
        return self::CSV_TYPE;
    }
}
