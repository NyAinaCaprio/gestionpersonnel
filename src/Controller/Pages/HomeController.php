<?php
/**
 * Created by PhpStorm.
 * User: DIA
 * Date: 01/03/2020
 * Time: 20:07
 */

namespace App\Controller\Pages;
use App\Entity\Detachement;
use App\Entity\ListeDeco;
use App\Entity\Personnel;
use App\Entity\EtsouService;
use App\Repository\EtsouServiceRepository;
use App\Repository\DirecteurRepository;
use App\Entity\PersonnelSearch;
use App\Form\ListeDecoType;
use App\Form\PersonnelSearchType;
use App\Repository\DecorationRepository;
use App\Repository\ListeDecoRepository;
use App\Repository\PersonnelRepository;
use Knp\Component\Pager\PaginatorInterface;
//use Psr\Link\LinkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class HomeController extends AbstractController
{
    /**
     * @var DirecteurRepository
     */
    private $directeurRepo;
    /**
     * @var EtsouServiceRepository
     */
    private $etsouServiceRepo;
    /**
     * @var ListeDecoRepository
     */
    private $listeDecoRepository;
    /**
     * @var PersonnelRepository
     */
    private $personnelRepo;

    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var DecorationRepository
     */
    private $decorationRepo;


    public function __construct(PersonnelRepository $personnelRepo, EtsouServiceRepository $etsouServiceRepo, DirecteurRepository $directeurRepo, ListeDecoRepository $listeDecoRepository, DecorationRepository $decorationRepo, CacheInterface $cache)
    {

        $this->decorationRepo = $decorationRepo;
        $this->listeDecoRepository = $listeDecoRepository;
        $this->personnelRepo = $personnelRepo;
        $this->etsouServiceRepo = $etsouServiceRepo;
        $this->directeurRepo = $directeurRepo;
        $this->cache = $cache;
    }

    /**
     * @Route("/", name="accueil.index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PersonnelSearch();
        $form  = $this->createForm(PersonnelSearchType::class, $search);
        $form->handleRequest($request);

            $directeur = $paginator->paginate(
            $this->directeurRepo->findDirecteur(),
            $request->query->getInt('page', 1),
            4
        );
 

        return $this->render('pages/home.html.twig', [
            'directeurs' => $directeur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("personnel/{id}", name="personnel.show")
     * @param Personnel $personnel
     * @return Response
     */
    public function show(Personnel $personnel): Response
    {
        return $this->render('pages/show.html.twig', [
            'personnel' => $personnel
        ]);

    }

    /**
     * @Route("/honorifique", name="home_honorifique")
     */
    public function honorifique(Request $request): Response
    {
        $listeDeco = $this->listeDecoRepository->findAll();
        return $this->render('pages/honorifique.html.twig', [
            'listedeco' => $listeDeco
        ]);
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

            $donnee = $this->decorationRepo->consultDeco($option,$mychoix,$anneeService,$age);
            return $this->render('pages/propositionDeco.html.twig', [
                'decorations' => $donnee,

            ]);
        }

        //$decorations = $this->personnelRepo->consultDeco($option, $mychoix);
        $decorations = $this->decorationRepo->consultDeco($option, $mychoix);
        return $this->render('pages/consultDeco.html.twig', [
            'decorations' => $decorations,
            'mychoix' => $mychoix,
            'option' => $option
        ]);



    }

    /**
     * @Route("retraite/{annee}", name="accueil.retraite", requirements = {"annee": "[0-9]{4}$"})
     * @param int $annee
     * @return Response
     */
    public function retraite(int $annee):Response
    {

        $retraite = $this->personnelRepo->groupRetraite();
        $personnel = $this->personnelRepo->findRetraiteByYear($annee);

        return $this->render('pages/retraite.html.twig',[
            'personnel' => $personnel,
            'retraite' => $retraite,
            'annee' => $annee
        ]);

    }


    /**
     * @Route("grouperetraite/", name="accueil.rouperetraite")
     * @return Response
     */
    public function groupRetraite()
    {

        $retraite = $this->personnelRepo->groupRetraite();
        return $this->render('pages/groupeRetraite.html.twig',[
            'retraite' => $retraite
        ]);
    }

    /**
     * @Route("detail/", name="home.detail")
     * @return Response
     */
    public function detail() :Response
    {

        $nombrePers = $this->personnelRepo->sommepersonnel();
        $sommeByCategorie = $this->personnelRepo->resSommeCategorie();
        $sumByEtsOuService = $this->personnelRepo->sumByEtsOuService();

        return $this->render('pages/detail.html.twig', [
            'nombrePersonnel' => $nombrePers,
            'sommeByCategorie'  => $sommeByCategorie,
            'sumByEtsOuService'  => $sumByEtsOuService,
        ]);

    }

    /**
     * @Route("listpersonnel/etsouservice/{id} ", name="home.listebyservice")
     * @return Response
     */
    public function listByService(EtsouService $etsouservice ) :Response
    {
        return $this->render('pages/listPersonnel.html.twig', [
            'etsouservices'=>$etsouservice,
        ]);

    }

    /**
     * @Route("listpersonnel/detachement/{id} ", name="home.listbydetache")
     * @return Response
     */
    public function listByDetache(Detachement $detachement ) :Response
    {
        return $this->render('pages/listPersonnel.html.twig', [
            'detachements'=>$detachement,
        ]);

    }


    /**
     * @Route("consultation", name="home.consultation")
     * @return Response
     */
    // public function Consultation(PaginatorInterface $paginator, Request $request) :Response
    // {
    //     $search = new PersonnelSearch();
    //     $form  = $this->createForm(PersonnelSearchType::class, $search);
    //     $form->handleRequest($request);

    //     /*l'autowiring de cache
    //     php bin/console debug:autowiring cache >>> cache.app
    //     */
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $personnel = $paginator->paginate(
    //             $this->personnelRepo->findAllVisibleQuery($search),
    //             $request->query->getInt('page', 1),
    //             20
    //         ); 
    //         return $this->render("pages/consultation.html.twig", [
    //             'personnels' => $personnel,
    //             'form'=>$form->createView()

    //         ]);
    //     }
        

    //     return $this->render('pages/consultation.html.twig', [
    //         'form'=>$form->createView(),
    //         'donnee' => "vide"
    //     ]);
    // }

    

}