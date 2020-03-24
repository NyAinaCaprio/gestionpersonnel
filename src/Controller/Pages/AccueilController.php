<?php
/**
 * Created by PhpStorm.
 * User: DIA
 * Date: 13/03/2020
 * Time: 16:21
 */

namespace App\Controller\Pages;


use App\Repository\DirecteurRepository;
use App\Repository\EtsouServiceRepository;
use App\Repository\PersonnelRepository;
use Psr\Link\LinkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @var EtsouServiceRepository
     */
    private $etsouServiceRepo;
    /**
     * @var DirecteurRepository
     */
    private $directeurRepo;
    /**
     * @var PersonnelRepository
     */
    private $personnelRepo;

    public function __construct(EtsouServiceRepository $etsouServiceRepo, DirecteurRepository $directeurRepo, PersonnelRepository $personnelRepo)

    {

        $this->etsouServiceRepo = $etsouServiceRepo;
        $this->directeurRepo = $directeurRepo;
        $this->personnelRepo = $personnelRepo;
    }
    /**
     * @Route("/", name="accueil.index")
     * @return Response
     */
    public function index():Response
    {
        $directeur = $this->directeurRepo->findDirecteur();
        $service = $this->etsouServiceRepo->findService();
        $ets = $this->etsouServiceRepo->findEts();

        return $this->render('pages/home.html.twig', [
            'services' => $service,
            'ets' => $ets,
            'directeurs' => $directeur
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

        return $this->render('accueil/retraite.html.twig',[
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
        return $this->render('accueil/groupeRetraite.html.twig',[
            'retraite' => $retraite
        ]);
    }
}