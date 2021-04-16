<?php

namespace App\Controller\admin;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/demande")
 */
class DemandeController extends AbstractController
{
    /**
     * @Route("/", name="demande_index", methods={"GET"})
     * @param DemandeRepository $demandeRepository
     * @return Response
     */
    public function index(DemandeRepository $demandeRepository): Response
    {
        return $this->render('admin/demande/index.html.twig', [
            'demandes' => $demandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demande_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('demande_index');
        }

        return $this->render('admin/demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_show", methods={"GET"})
     * @param Demande $demande
     * @return Response
     */
    public function show(Demande $demande): Response
    {
        return $this->render('admin/demande/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Demande $demande
     * @return Response
     */
    public function edit(Request $request, Demande $demande): Response
    {
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_index');
        }

        return $this->render('admin/demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/valide", name="valide_demande", methods={"GET","POST"})
     * @param Request $request
     * @param Demande $demande
     *
     */

    public function validerDemande(Request $request,Demande $demande)
    {
        $demande->setStatut(Demande::STATUT_IN_PREPARATION);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($demande);
        $entityManager->flush();
        return $this->redirectToRoute('demande_index');


    }
    /**
     * @Route("/{id}/terminer", name="terminer_demande", methods={"GET","POST"})
     * @param Request $request
     * @param Demande $demande
     *
     */
    public function terminserDemande(Request $request,Demande $demande){
        $demande->setStatut(Demande::STATUT_COMPLETED);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($demande);
        $entityManager->flush();
        return $this->redirectToRoute('demande_index');
    }
     /**
     * @Route("/{id}/refuse", name="refuser_demande", methods={"GET","POST"})
     * @param Request $request
     * @param Demande $demande
     *
     */
    public function refuserDemande(Request $request,Demande $demande)
    {
        $demande->setStatut(Demande::STATUT_REFUSE);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($demande);
        $entityManager->flush();
        return $this->redirectToRoute('demande_index');
    }
    /**
     * @Route("/{id}", name="demande_delete", methods={"POST"})
     * @param Request $request
     * @param Demande $demande
     * @return Response
     */
    public function delete(Request $request, Demande $demande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_index');
    }


}
