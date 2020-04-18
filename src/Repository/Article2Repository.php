<?php

namespace App\Repository;

use App\Entity\Article2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article2[]    findAll()
 * @method Article2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Article2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article2::class);
    }

    // /**
    //  * @return Article2[] Returns an array of Article2 objects
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
    public function findOneBySomeField($value): ?Article2
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
