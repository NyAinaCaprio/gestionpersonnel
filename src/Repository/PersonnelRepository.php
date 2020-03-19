<?php

namespace App\Repository;

use App\Entity\Personnel;
use App\Entity\PersonnelSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method Personnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnel[]    findAll()
 * @method Personnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnelRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var CategorieRepository
     */
    private $repository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em, CategorieRepository $repository)
    {
        parent::__construct($registry, Personnel::class);
        $this->em = $em;
        $this->repository = $repository;
    }
    /**
     * @param Personnel[]
     * @return Query
     */
    public function findAllVisibleQuery(PersonnelSearch $search): Query
    {

         $query =  $this->findVisibleQuery();

         if ($search->getNomprenom())
         {
             $query = $query->andWhere('p.nomprenom LIKE :nomprenom')
                 ->setParameter('nomprenom', '%'.$search->getNomprenom().'%');

         }
        if ($search->getEtsouservice())
        {
            $query = $query->andWhere('p.etsouservice = :service')
                ->setParameter('service',$search->getEtsouservice());

        }
        if ($search->getCategorie())
        {
            $query = $query->andWhere('p.categorie = :categorie')
                ->setParameter('categorie',$search->getCategorie());

        }
        if ($search->getDetachement())
        {
            $query = $query->andWhere('p.detachement = :detache')
                ->setParameter('detache',$search->getDetachement());

        }

             return $query->getQuery();

    }


    /**
     * @return Personnel[]
     */
    public function findAllPers(): array
    {
        return $this->findVisibleQuery()
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;

    }

    // /**
    //  * @return Personnel[] Returns an array of Personnel objects
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

    
    public function findOneById($value): ?Personnel
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /**
     * @return QueryBuilder
     */
    public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.rupture = :val')
            ->setParameter('val', "En activite")
            ->orderBy('p.id', 'DESC')
            ;
    }

    public function sommepersonnel()
    {
        return $this->findVisibleQuery()
            ->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult();

    }

    public function sommeECD()
    {
        return $this->findVisibleQuery()
            ->andWhere('p.categorie = 2')
            ->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult();

    }

    public function sommeEFA()
    {
        return $this->findVisibleQuery()
            ->andWhere('p.categorie = 3')
            ->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function sommeFONCT()
    {
        return $this->findVisibleQuery()
            ->andWhere('p.categorie = 4')
            ->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult();
    }


    /*   public function sommeParCategorie($var)
       {
           return $this->createQueryBuilder('p')
               ->Where('p.categorie = :val')
               ->setParameter('val', $var)
               ->select('COUNT(p)')
               ->getQuery()
               ->getResult();
       }


       public function calculeParCategorie()
       {

           $query = $this->repository->findAll();

           $total = $this->sommepersonnel();

           foreach ($query as $key => $value) {

               $nb = $this->sommeParCategorie($value->getId()) ;
               $res[] = [
                   'categorie'=>$value->getCategorie(),
                   'nombre'=>$nb,
                   'total' => $total
               ];

           }


               return $res;

       }*/


}
