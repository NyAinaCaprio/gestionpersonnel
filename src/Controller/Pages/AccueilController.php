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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @var EtsouServiceRepository
     */
    private $repository;
    /**
     * @var DirecteurRepository
     */
    private $repositoriDrecteur;

    public function __construct(EtsouServiceRepository $repository, DirecteurRepository $repositoriDrecteur)
    {
        $this->repository = $repository;
        $this->repositoriDrecteur = $repositoriDrecteur;
    }

    /**
     * @Route("/", name="accueil.index")
     * @return Response
     */
    public function index():Response
    {
        $directeur = $this->repositoriDrecteur->findDirecteur();

        $service = $this->repository->findService();
        $ets = $this->repository->findEts();

        return $this->render('pages/home.html.twig', [
            'services' => $service,
            'ets' => $ets,
            'directeurs' => $directeur
        ]);

    }
}