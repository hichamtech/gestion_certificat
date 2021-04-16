<?php

namespace App\Controller\etudiant;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * @Route("etudiant/demande")
 */
class DemandeEtudiantController extends AbstractController
{

    /**
     * @Route("/", name="demande_etudiant_index", methods={"GET"})
     * @param DemandeRepository $demandeRepository
     * @return Response
     */
    public function index(DemandeRepository $demandeRepository,UserInterface $user): Response
    {
        return $this->render('etudiant/demande/index.html.twig', [
            'demandes' => $demandeRepository->findByUserField($user),
        ]);
    }

   /**
     * @Route("/new", name="demande_etudiant_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request,UserInterface $user): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $demande->setStatut(Demande::STATUT_IN_PROGRESS);
            $demande->setUser($user);
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('demande_etudiant_index');
        }

        return $this->render('etudiant/demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }
   

}
