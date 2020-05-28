<?php

namespace App\Repository;

use App\Entity\Decoration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Decoration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decoration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decoration[]    findAll()
 * @method Decoration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecorationRepository extends ServiceEntityRepository
{
    /**
     * @var PersonnelRepository
     */
    private $personnelRepo;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ManagerRegistry $registry, PersonnelRepository $personnelRepo, EntityManagerInterface $em)
    {
        parent::__construct($registry, Decoration::class);
        $this->personnelRepo = $personnelRepo;
        $this->em = $em;
    }


    public function consultDeco($option, $mychoix, $anneeService= null, $age = null){
        if ($option == "consultation"){
            return $this->createQueryBuilder('d')
                ->innerJoin('d.personnel', 'pers')
                ->innerJoin('d.listedeco', 'listedeco')
                ->addSelect('listedeco.decoration, d.decretouarrete, d.annee,pers.nomprenom')
                ->where('listedeco.id = :listedeco')
                ->andWhere('pers.rupture = :rupture')
                ->setParameter('listedeco', $mychoix)
                ->setParameter('rupture', 'En activité')
                ->getQuery()
                ->getResult();
        }else{

            return $this->createQueryBuilder('d')
                ->innerJoin('d.personnel','pers')
                ->addSelect('YEAR(CURRENT_DATE()) - Year(pers.daterecrute) as anneeService, Year(CURRENT_DATE()) - Year(pers.datenaisse) as age, pers.nomprenom, pers.daterecrute')
                ->where('YEAR(CURRENT_DATE()) - Year(pers.daterecrute) >= :anneeService')
                ->groupBy('pers.nomprenom')
                ->andWhere('YEAR(CURRENT_DATE()) - Year(pers.datenaisse) >= :age')
                ->setParameter('anneeService', $anneeService)
                ->setParameter('age', $age)
                ->getQuery()
                ->getResult();
        }
    }



    // /**
    //  * @return Decoration[] Returns an array of Decoration objects
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
    public function findOneBySomeField($value): ?Decoration
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
