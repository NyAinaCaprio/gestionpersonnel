<?php

namespace App\Controller\Admin;

use App\Entity\Directeur;
use App\Form\DirecteurType;
use App\Repository\DirecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/directeur")
 */
class DirecteurController extends AbstractController
{
    /**
     * @Route("/", name="directeur_index", methods={"GET"})
     */
    public function index(DirecteurRepository $directeurRepository): Response
    {
        return $this->render('directeur/index.html.twig', [
            'directeurs' => $directeurRepository->findDirecteur(),
        ]);
    }

    /**
     * @Route("/new", name="directeur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $directeur = new Directeur();
        $form = $this->createForm(DirecteurType::class, $directeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($directeur);
            $entityManager->flush();

            return $this->redirectToRoute('directeur_index');
        }

        return $this->render('directeur/new.html.twig', [
            'directeur' => $directeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="directeur_show", methods={"GET"})
     */
    public function show(Directeur $directeur): Response
    {
        return $this->render('directeur/show.html.twig', [
            'directeur' => $directeur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="directeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Directeur $directeur): Response
    {
        $form = $this->createForm(DirecteurType::class, $directeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('directeur_index');
        }

        return $this->render('directeur/edit.html.twig', [
            'directeur' => $directeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="directeur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Directeur $directeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$directeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($directeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('directeur_index');
    }
}
