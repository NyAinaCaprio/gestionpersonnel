<?php

namespace App\Repository;

use App\Entity\ListeDeco;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListeDeco|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeDeco|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeDeco[]    findAll()
 * @method ListeDeco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeDecoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeDeco::class);
    }

    // /**
    //  * @return ListeDeco[] Returns an array of ListeDeco objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeDeco
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
