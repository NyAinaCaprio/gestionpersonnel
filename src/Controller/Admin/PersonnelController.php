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


    public function __construct( EntityManagerInterface $em, PersonnelRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("admin/", name="personnel.index")
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {
        $sommeECD = $this->repository->sommeECD();
        $sommeEFA = $this->repository->sommeEFA();
        $sommeFONCT = $this->repository->sommeFONCT();

        $nombrePers = $this->repository->sommepersonnel();

        $search = new PersonnelSearch();
        $form  = $this->createForm(PersonnelSearchType::class, $search);
        $form->handleRequest($request);


        $personnel = $paginator->paginate(
            $this-> repository->findAllVisibleQuery($search), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );
        return $this->render('admin/index.html.twig', [
                'personnels' => $personnel,
            'form' => $form->createView(),
            'nombrePersonnel' => $nombrePers,
            'sommeECD' => $sommeECD,
            'sommeEFA' => $sommeEFA,
            'sommeFONCT' => $sommeFONCT,
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


        $form = $this->createForm(PersonnelType::class,$personnel);
        $form->handleRequest($request);

        /*if (!$form->isValid())
        {
            return   $this->render('admin/new.html.twig',[
                'form' => $form->createView()
            ]);
        }*/

       if ($form->isSubmitted())
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
     public function edit(Personnel $personnel, String $slug, Request $request):Response
     {
         $personnel = $this->repository->findOneById($personnel);
         $form = $this->createForm(PersonnelType::class, $personnel);
         $form->handleRequest($request);

         if ($form->isSubmitted())
         {

             $this->em->flush();
             $this->addFlash('success', "Modification éfféctué avec succes !");
           return $this->redirectToRoute('personnel.index');
         }

         return $this->render("admin/edit.html.twig", [
             'personnel' => $personnel,
             'form' => $form->createView(),
         ]);


     }

}