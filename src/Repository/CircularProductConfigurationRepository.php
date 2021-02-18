<?php

namespace App\Repository;

use App\Entity\CircularProductConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CircularProductConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method CircularProductConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method CircularProductConfiguration[]    findAll()
 * @method CircularProductConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircularProductConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CircularProductConfiguration::class);
    }

    // /**
    //  * @return CircularProductConfiguration[] Returns an array of CircularProductConfiguration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CircularProductConfiguration
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
