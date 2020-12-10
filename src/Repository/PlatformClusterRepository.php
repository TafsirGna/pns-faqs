<?php

namespace App\Repository;

use App\Entity\PlatformCluster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlatformCluster|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatformCluster|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatformCluster[]    findAll()
 * @method PlatformCluster[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformClusterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatformCluster::class);
    }

    // /**
    //  * @return PlatformCluster[] Returns an array of PlatformCluster objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlatformCluster
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
