<?php


namespace App\Service\ProductConfigurationImport;


use App\Entity\Product;
use App\Entity\ProductConfiguration\ProductConfiguration;
use App\Repository\ProductRepository;
use App\Service\ProductConfigurationImport\Builder\Builder;
use App\Service\ProductConfigurationImport\Builder\BuilderDirector;
use App\Service\ProductConfigurationImport\Builder\CircularBuilder;
use App\Service\ProductConfigurationImport\Builder\ConcreteBuilderPool;
use App\Service\ProductConfigurationImport\Builder\RectangularBuilder;
use App\Service\ProductConfigurationImport\Iterator\IteratorFactory;
use Doctrine\ORM\EntityManagerInterface;

class ImportService
{
    private IteratorFactory $iteratorFactory;
    private EntityManagerInterface $manager;
    private ProductRepository $productRepository;
    private ConcreteBuilderPool $builderPool;

    public function __construct(IteratorFactory $iteratorFactory, EntityManagerInterface $manager, ProductRepository $productRepository, ConcreteBuilderPool $builderPool)
    {
        $this->iteratorFactory = $iteratorFactory;
        $this->manager = $manager;
        $this->productRepository = $productRepository;
        $this->builderPool = $builderPool;
    }

    public function importProductConfiguration(string $data, string $format): int
    {
        $director = new BuilderDirector();
        $iterator = $this->iteratorFactory->createIterator($data, $format);
        $inserted = 0;

        while ($iterator->hasMore()) {
            $row = $iterator->current();

            $builder = $this->selectBuilder($row);
            $director->setBuilder($builder);

            $product = $this->productRepository->findOrCreate($row);

            $productConfiguration = $director->make($row);
            if (!$this->productRepository->isDuplicate($product, $productConfiguration)) {
                $product->addConfiguration($productConfiguration);
                $inserted++;
            }

            $iterator->next();
        }
        $this->manager->flush();

        return $inserted;
    }

    private function selectBuilder(array $row): Builder {
        switch ($row['Type']) {
            case CircularBuilder::DISCRIMINATOR:
                return $this->builderPool->get(CircularBuilder::class);
            case RectangularBuilder::DISCRIMINATOR:
                return $this->builderPool->get(RectangularBuilder::class);
            default:
                throw new \LogicException("Unsupported row format");
        }
    }
}
