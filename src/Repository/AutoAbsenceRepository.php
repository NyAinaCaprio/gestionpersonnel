<?php

namespace App\Repository;

use App\Entity\AutoAbsence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method AutoAbsence|null find($id, $lockMode = null, $lockVersion = null)
 * @method AutoAbsence|null findOneBy(array $criteria, array $orderBy = null)
 * @method AutoAbsence[]    findAll()
 * @method AutoAbsence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoAbsenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutoAbsence::class);
    }

    /**
     * @param AutoAbsence[]
     * @return Query
     */
    public function findAllAbsenceQuery(): Query
    {

        $query =  $this->findVisibleQuery();
/*
        if ($search->getNomprenom())
        {
            $query = $query->andWhere('p.nomprenom LIKE :nomprenom')
                ->setParameter('nomprenom', '%'.$search->getNomprenom().'%');

        }
        */

        return $query->getQuery();

    }

    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.date', 'DESC')
        ;


    }

    // /**
    //  * @return AutoAbsence[] Returns an array of AutoAbsence objects
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
    public function findOneBySomeField($value): ?AutoAbsence
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
