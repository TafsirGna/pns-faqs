<?php

namespace App\Repository;

use App\Entity\PlateformGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlateformGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlateformGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlateformGroup[]    findAll()
 * @method PlateformGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlateformGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlateformGroup::class);
    }

    // /**
    //  * @return PlateformGroup[] Returns an array of PlateformGroup objects
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
    public function findOneBySomeField($value): ?PlateformGroup
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
