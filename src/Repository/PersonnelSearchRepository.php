<?php

namespace App\Repository;

use App\Entity\PersonnelSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonnelSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonnelSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonnelSearch[]    findAll()
 * @method PersonnelSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonnelSearch::class);
    }

    // /**
    //  * @return PersonnelSearch[] Returns an array of PersonnelSearch objects
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
    public function findOneBySomeField($value): ?PersonnelSearch
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
