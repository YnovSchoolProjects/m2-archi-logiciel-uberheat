<?php


namespace App\Service\ProductConfigurationImport\Iterator;


class CsvIterator implements Iterator
{

    private string $rawData;
    private int $position;
    private array $parsedData;

    public function __construct(string $data)
    {
        $this->position = 0;
        $this->rawData = $data;
        $this->parseData();
    }

    private function parseData(): void
    {
        $trimmed = trim($this->rawData);
        $lines = preg_split("/\r\n/", $trimmed);

        // for memory
        unset($trimmed);

        $csvLines = array_map(function ($line) {
            return explode(";", $line);
        }, $lines);
        $keys = array_shift($csvLines);

        foreach ($csvLines as $index => $row) {
            $csvLines[$index] = array_combine($keys, $row);
        }

        $this->parsedData = $csvLines;
    }

    public function next(): void
    {
        if ($this->hasMore()) {
            $this->position++;
        }
    }

    public function current(): array
    {
        return $this->parsedData[$this->position];
    }

    public function hasMore(): bool
    {
        return $this->position < count($this->parsedData);
    }
}
