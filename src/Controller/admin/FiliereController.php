<?php

namespace App\Controller\admin;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/filiere")
 */
class FiliereController extends AbstractController
{
    /**
     * @Route("/", name="filiere_index", methods={"GET"})
     * @param FiliereRepository $filiereRepository
     * @return Response
     */
    public function index(FiliereRepository $filiereRepository): Response
    {
        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="filiere_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($filiere);
            $entityManager->flush();

            return $this->redirectToRoute('filiere_index');
        }

        return $this->render('admin/filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filiere_show", methods={"GET"})
     * @param Filiere $filiere
     * @return Response
     */
    public function show(Filiere $filiere): Response
    {
        return $this->render('admin/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="filiere_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Filiere $filiere
     * @return Response
     */
    public function edit(Request $request, Filiere $filiere): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('filiere_index');
        }

        return $this->render('admin/filiere/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filiere_delete", methods={"POST"})
     * @param Request $request
     * @param Filiere $filiere
     * @return Response
     */
    public function delete(Request $request, Filiere $filiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filiere_index');
    }
}
