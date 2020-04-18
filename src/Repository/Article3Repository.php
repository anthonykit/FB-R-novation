<?php

namespace App\Repository;

use App\Entity\Article3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article3[]    findAll()
 * @method Article3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Article3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article3::class);
    }

    // /**
    //  * @return Article3[] Returns an array of Article3 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article3
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
