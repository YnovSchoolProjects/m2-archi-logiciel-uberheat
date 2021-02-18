<?php


namespace App\Service\ProductConfigurationImport;


use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\ProductConfigurationImport\Builder\Builder;
use App\Service\ProductConfigurationImport\Builder\BuilderDirector;
use App\Service\ProductConfigurationImport\Builder\CircularBuilder;
use App\Service\ProductConfigurationImport\Builder\RectangularBuilder;
use App\Service\ProductConfigurationImport\Iterator\IteratorFactory;
use Doctrine\ORM\EntityManagerInterface;

class ImportService
{
    private IteratorFactory $iteratorFactory;
    private EntityManagerInterface $manager;
    private ProductRepository $productRepository;

    public function __construct(IteratorFactory $iteratorFactory, EntityManagerInterface $manager, ProductRepository $productRepository)
    {
        $this->iteratorFactory = $iteratorFactory;
        $this->manager = $manager;
        $this->productRepository = $productRepository;
    }

    public function importProductConfiguration(string $data, string $format): void
    {
        $director = new BuilderDirector();
        $iterator = $this->iteratorFactory->createIterator($data, $format);

        while ($iterator->hasMore()) {
            $row = $iterator->current();

            $builder = $this->selectBuilder($row);
            $director->setBuilder($builder);

            $product = $this->productRepository->findOneBy(['name' => $row['Article']]);

            if ($product === null) {
                $product = new Product();
                $product->setName($row['Article']);
            }

            // @todo avoid configuration duplication (addConfiguration do it only with ProductConfiguration#id)
            $product->addConfiguration($director->make($row));
            $this->manager->persist($product);

            // @todo avoid flush at each operation (but for now needed for the findOneBy)
            $this->manager->flush();
            $iterator->next();
        }
    }

    private function selectBuilder(array $row): Builder {
        switch ($row['Type']) {
            case CircularBuilder::DISCRIMINATOR:
                return new CircularBuilder();
            case RectangularBuilder::DISCRIMINATOR:
                return new RectangularBuilder();
            default:
                throw new \LogicException("Unsupported row format");
        }
    }
}
