<?php

namespace App\Controller\Admin;

use App\Entity\EtsouService;
use App\Form\EtsouService2Type;
use App\Repository\EtsouServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/etsouservice")
 */
class EtsouServiceController extends AbstractController
{
    /**
     * @Route("/", name="etsou_service_index", methods={"GET"})
     */
    public function index(EtsouServiceRepository $etsouServiceRepository): Response
    {
        return $this->render('etsou_service/index.html.twig', [
            'etsou_services' => $etsouServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etsou_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etsouService = new EtsouService();
        $form = $this->createForm(EtsouService2Type::class, $etsouService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etsouService);
            $entityManager->flush();

            return $this->redirectToRoute('etsou_service_index');
        }

        return $this->render('etsou_service/new.html.twig', [
            'etsou_service' => $etsouService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etsou_service_show", methods={"GET"})
     */
    public function show(EtsouService $etsouService): Response
    {
        return $this->render('etsou_service/show.html.twig', [
            'etsou_service' => $etsouService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etsou_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EtsouService $etsouService): Response
    {
        $form = $this->createForm(EtsouService2Type::class, $etsouService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etsou_service_index');
        }

        return $this->render('etsou_service/edit.html.twig', [
            'etsou_service' => $etsouService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etsou_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EtsouService $etsouService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etsouService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etsouService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etsou_service_index');
    }
}
