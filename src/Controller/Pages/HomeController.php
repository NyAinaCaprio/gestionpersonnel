<?php
/**
 * Created by PhpStorm.
 * User: DIA
 * Date: 01/03/2020
 * Time: 20:07
 */

namespace App\Controller\Pages;
use App\Entity\ListeDeco;
use App\Entity\Personnel;
use App\Entity\PersonnelSearch;
use App\Form\PersonnelSearchType;
use App\Repository\DecorationRepository;
use App\Repository\ListeDecoRepository;
use App\Repository\PersonnelRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var PersonnelRepository
     */
    private $repository;
    /**
     * @var DecorationRepository
     */
    private $decorepo;
    /**
     * @var ListeDecoRepository
     */
    private $listeDecoRepository;

    public function __construct(PersonnelRepository $repository, DecorationRepository $decorepo, ListeDecoRepository $listeDecoRepository)
    {
        $this->repository = $repository;
        $this->decorepo = $decorepo;
        $this->listeDecoRepository = $listeDecoRepository;
    }

    /**
     * @Route("list/", name="home")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PersonnelSearch();
        $form  = $this->createForm(PersonnelSearchType::class, $search);
        $form->handleRequest($request);

        $personnel = $paginator->paginate(
            $this-> repository->findAllVisibleQuery($search), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        if ($search->getNomprenom() || $search->getEtsouservice() || $search->getCategorie() || $search->getDetachement())
        {
            $recherche = 'resultat';
        }else{

            $recherche = "";
        }


       return $this->render("pages/home.html.twig", [
            'personnels' => $personnel,
           'form' => $form->createView(),
           'recherche' => $recherche
        ]);


    }

    /**
     * @Route("personnel/{id}", name="personnel.show" )
     * @param Personnel $personnel
     * @return Response
     */
    public function show(Personnel $personnel): \Symfony\Component\HttpFoundation\Response
    {
        $personnel = $this->repository->find($personnel);
        return $this->render('pages/show.html.twig', [
            'personnel' => $personnel
        ]);

    }

    /**
     * @Route("/honorifique", name="home_honorifique")
     */
    public function honorifique(): Response
    {
        return $this->render('pages/honorifique.html.twig');
    }

    /**
     * @Route("/honorifique/consultation/", name="home_consultDeco")
     * @param Request $request
     * @return Response
     */
    public function consultDeco(Request $request): Response
    {
        $option = $request->get('option');
        $mychoix = $request->get('mychoix');

        if ($option == "proposition"){

            $data= $this->listeDecoRepository->find($mychoix);
            $age = $data->getAge();
            $anneeService = $data->getAnneeservice();

            $donnee = $this->repository->consultDeco($option,$mychoix,$anneeService,$age);
            return $this->render('pages/propositionDeco.html.twig', [
                'decorations' => $donnee,

            ]);
        }

        $decorations = $this->repository->consultDeco($option, $mychoix);
        return $this->render('pages/consultDeco.html.twig', [
            'decorations' => $decorations,
            'mychoix' => $mychoix,
            'option' => $option
        ]);



    }



}