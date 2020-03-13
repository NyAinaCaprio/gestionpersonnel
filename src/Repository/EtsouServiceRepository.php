<?php

namespace App\Repository;

use App\Entity\EtsouService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EtsouService|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtsouService|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtsouService[]    findAll()
 * @method EtsouService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtsouServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtsouService::class);
    }

    // /**
    //  * @return EtsouService[] Returns an array of EtsouService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtsouService
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
