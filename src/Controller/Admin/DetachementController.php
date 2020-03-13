<?php

namespace App\Controller\Admin;

use App\Entity\Detachement;
use App\Form\DetachementType;
use App\Repository\DetachementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/detachement")
 */
class DetachementController extends AbstractController
{
    /**
     * @Route("/", name="detachement_index", methods={"GET"})
     */
    public function index(DetachementRepository $detachementRepository): Response
    {
        return $this->render('detachement/index.html.twig', [
            'detachements' => $detachementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detachement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detachement = new Detachement();
        $form = $this->createForm(DetachementType::class, $detachement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detachement);
            $entityManager->flush();

            return $this->redirectToRoute('detachement_index');
        }

        return $this->render('detachement/new.html.twig', [
            'detachement' => $detachement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detachement_show", methods={"GET"})
     */
    public function show(Detachement $detachement): Response
    {
        return $this->render('detachement/show.html.twig', [
            'detachement' => $detachement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detachement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Detachement $detachement): Response
    {
        $form = $this->createForm(DetachementType::class, $detachement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detachement_index');
        }

        return $this->render('detachement/edit.html.twig', [
            'detachement' => $detachement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detachement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Detachement $detachement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detachement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detachement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detachement_index');
    }
}
