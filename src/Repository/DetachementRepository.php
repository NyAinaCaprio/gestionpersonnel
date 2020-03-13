<?php

namespace App\Repository;

use App\Entity\Detachement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Detachement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detachement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detachement[]    findAll()
 * @method Detachement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetachementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detachement::class);
    }

    // /**
    //  * @return Detachement[] Returns an array of Detachement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detachement
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
