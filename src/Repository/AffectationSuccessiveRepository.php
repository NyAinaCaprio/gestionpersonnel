<?php

namespace App\Repository;

use App\Entity\AffectationSuccessive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AffectationSuccessive|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffectationSuccessive|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffectationSuccessive[]    findAll()
 * @method AffectationSuccessive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectationSuccessiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AffectationSuccessive::class);
    }

    // /**
    //  * @return AffectationSuccessive[] Returns an array of AffectationSuccessive objects
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
    public function findOneBySomeField($value): ?AffectationSuccessive
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
