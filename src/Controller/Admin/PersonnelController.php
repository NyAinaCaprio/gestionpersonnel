<?php
namespace App\Controller\Admin;

use App\Entity\PersonnelSearch;
use App\Form\PersonnelSearchType;
use App\Repository\EtsouServiceRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\validator\validator\ValidatorInterface;
class PersonnelController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var PersonnelRepository
     */
    private $repository;


    public function __construct( EntityManagerInterface $em, PersonnelRepository $repository )
    {

        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("personnel/", name="personnel.index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
{       
        $search = new PersonnelSearch();
        $form  = $this->createForm(PersonnelSearchType::class, $search);
        $form->handleRequest($request);
        
        $sommeECD = $this->repository->sommeECD();
        $sommeEFA = $this->repository->sommeEFA();
        $sommeFONCT = $this->repository->sommeFONCT();

        $nombrePers = $this->repository->sommepersonnel();

        $ecd = ceil(($sommeECD / $nombrePers)*100);
        $efa = ceil(($sommeEFA / $nombrePers)*100);
        $fonct = ceil(($sommeFONCT / $nombrePers)*100); 

            $personnel = $paginator->paginate(
            $this-> repository->findAllVisibleQuery($search ), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );
        

        
        return $this->render('admin/index.html.twig', [
            'personnels' => $personnel,
            'form' => $form->createView(),
            'nombrePersonnel' => $nombrePers,
            'sommeECD' => $ecd,
            'sommeEFA' => $efa,
            'sommeFONCT' => $fonct,
            'effectECD' => $sommeECD,
            'effectEFA' => $sommeEFA,
            'effectFONCT' => $sommeFONCT,
        ]);

    }

    /**
     * @Route("admin/personnel/new", name="personnel.new")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request):Response
    {
        $personnel = new Personnel();

/*

        $errors = $validator->validate($personnel);
        if (count($errors) > 0) {
            $errors = (string)$errors;
            return $this->redirectToRoute('personnel.new', [
                '$errors' => $errors
                ],301);
        }
*/
        
        $form = $this->createForm(PersonnelType::class,$personnel);
        $form->handleRequest($request);


       if ($form->isSubmitted() and $form->isValid())
        {
            $date = $personnel->getDatenaisse();
            $date = date_add($date, date_interval_create_from_date_string('65 years'));
            $personnel->setDateRetraite(new \DateTime(date_format($date, 'Y-m-d'))) ;
 

            $this->em->persist($personnel);

            $this->em->flush();
            $this->addFlash('success', "Enregistrement éfféctué avec succes !");
            return $this->redirectToRoute('personnel.new');
        }

        return   $this->render('admin/new.html.twig',[
            'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("admin/personnel/{slug}-{id}", name="personnel.edit" , requirements = {"slug": "[a-z0-9\-]*"})
     * @param Personnel $personnel
     * @return Response
     */
     public function edit(Personnel $personnel, String $slug = null , Request $request):Response
     {
         $personnel = $this->repository->findOneById($personnel);
         $form = $this->createForm(PersonnelType::class, $personnel);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid())
         {

             $this->em->flush();
             $this->addFlash('success', "Modification éfféctué avec succes !");
           return $this->redirectToRoute('personnel.show', [
            'id' => $personnel->getId(),
            'slug' => $personnel->getSlug()
           ]);
         }

         return $this->render("admin/edit.html.twig", [
             'personnel' => $personnel,
             'form' => $form->createView(),
         ]);


     }
     
}