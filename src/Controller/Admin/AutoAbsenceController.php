<?php

namespace App\Controller\Admin;

use App\Entity\AutoAbsence;
use App\Entity\EtsouService;
use App\Entity\Personnel;
use App\Form\AutoAbsenceType;
use App\Repository\AutoAbsenceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/absence")
 */
class AutoAbsenceController extends AbstractController
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;
    /**
     * @var AutoAbsenceRepository
     */
    private $repository;

    public function __construct(PaginatorInterface $paginator, AutoAbsenceRepository $repository )
    {

        $this->paginator = $paginator;
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="auto_absence_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $autoabsence = $this->paginator->paginate(
            $this->repository->findAllAbsenceQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        return $this->render('auto_absence/index.html.twig', [
            'auto_absences' => $autoabsence,
        ]);
    }

    /**
     * @Route("/new/{id}-{slug}", name="auto_absence_new", methods={"GET","POST"}, requirements = {"slug": "[a-z0-9\-]*"})
     */
    public function new(Personnel $personnel,  Request $request, String $slug): Response
    {

        if (!$personnel->getEtsouservice()){
            $this->addFlash('success', "Personnel hors du service  !");
            return $this->redirectToRoute('personnel.index');
        }
        $autoAbsence = new AutoAbsence();
        $autoAbsence->setPersonnel($personnel);
        $autoAbsence->setEtsouservice($personnel->getEtsouservice());

        $form = $this->createForm(AutoAbsenceType::class, $autoAbsence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($autoAbsence);
            $entityManager->flush();

            return $this->redirectToRoute('auto_absence_index');
        }

        return $this->render('auto_absence/new.html.twig', [
            'auto_absence' => $autoAbsence,
            'personnel' => $personnel,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="auto_absence_show", methods={"GET"})
     */
    public function show(AutoAbsence $autoAbsence): Response
    {
        return $this->render('auto_absence/show.html.twig', [
            'auto_absence' => $autoAbsence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="auto_absence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AutoAbsence $autoAbsence): Response
    {
        $form = $this->createForm(AutoAbsenceType::class, $autoAbsence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auto_absence_index');
        }

        return $this->render('auto_absence/edit.html.twig', [
            'auto_absence' => $autoAbsence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auto_absence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AutoAbsence $autoAbsence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autoAbsence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autoAbsence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('auto_absence_index');
    }


}
