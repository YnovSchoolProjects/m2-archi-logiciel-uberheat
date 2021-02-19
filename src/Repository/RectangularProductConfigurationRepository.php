<?php

namespace App\Repository;

use App\Entity\ProductConfiguration\RectangularProductConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RectangularProductConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectangularProductConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectangularProductConfiguration[]    findAll()
 * @method RectangularProductConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectangularProductConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectangularProductConfiguration::class);
    }
}
