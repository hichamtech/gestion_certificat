<?php

namespace App\Controller\admin;

use App\Entity\TypeDemande;
use App\Form\TypeDemandeType;
use App\Repository\TypeDemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/type/demande")
 */
class TypeDemandeController extends AbstractController
{
    /**
     * @Route("/", name="type_demande_index", methods={"GET"})
     * @param TypeDemandeRepository $typeDemandeRepository
     * @return Response
     */
    public function index(TypeDemandeRepository $typeDemandeRepository): Response
    {
        return $this->render('admin/type_demande/index.html.twig', [
            'type_demandes' => $typeDemandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_demande_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $typeDemande = new TypeDemande();
        $form = $this->createForm(TypeDemandeType::class, $typeDemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDemande);
            $entityManager->flush();

            return $this->redirectToRoute('type_demande_index');
        }

        return $this->render('admin/type_demande/new.html.twig', [
            'type_demande' => $typeDemande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_demande_show", methods={"GET"})
     * @param TypeDemande $typeDemande
     * @return Response
     */
    public function show(TypeDemande $typeDemande): Response
    {
        return $this->render('admin/type_demande/show.html.twig', [
            'type_demande' => $typeDemande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_demande_edit", methods={"GET","POST"})
     * @param Request $request
     * @param TypeDemande $typeDemande
     * @return Response
     */
    public function edit(Request $request, TypeDemande $typeDemande): Response
    {
        $form = $this->createForm(TypeDemandeType::class, $typeDemande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_demande_index');
        }

        return $this->render('admin/type_demande/edit.html.twig', [
            'type_demande' => $typeDemande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_demande_delete", methods={"POST"})
     * @param Request $request
     * @param TypeDemande $typeDemande
     * @return Response
     */
    public function delete(Request $request, TypeDemande $typeDemande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDemande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDemande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_demande_index');
    }
}
