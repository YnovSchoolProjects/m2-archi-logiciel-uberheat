<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductConfiguration\ProductConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findOrCreate(array $row): Product
    {
        $product = $this->findOneBy(['name' => $row['Article']]);

        if ($product === null) {
            $product = new Product();
            $product->setName($row['Article']);
            $this->getEntityManager()->persist($product);
            $this->getEntityManager()->flush();
        }

        return $product;
    }

    public function isDuplicate(Product $product, ProductConfiguration $configuration): bool
    {
        /** @var ProductConfiguration $existingConfiguration */
        foreach ($product->getConfigurations() as $existingConfiguration) {
            if ($existingConfiguration->isEqual($configuration)) {
                return true;
            }
        }
        return false;
    }
}
