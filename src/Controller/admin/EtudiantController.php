<?php

namespace App\Controller\admin;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/etudiant")
 */
class EtudiantController extends AbstractController
{
    
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("/", name="etudiant_index", methods={"GET"})
     * @param EtudiantRepository $etudiantRepository
     * @return Response
     */
    public function index(EtudiantRepository $etudiantRepository): Response
    {
        return $this->render('admin/etudiant/index.html.twig', [
            'etudiants' => $etudiantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etudiant_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //creation user 
            $user = new User();
            $user->setEmail($etudiant->getNom().".".$etudiant->getPrenom()."@ensa.ma");
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $etudiant->getCin()
            ));
            $user->setRoles([User::ROLE_ETUDIANT]);

            $etudiant->setUser($user);

            $entityManager->persist($user);
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_index');
        }

        return $this->render('admin/etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_show", methods={"GET"})
     * @param Etudiant $etudiant
     * @return Response
     */
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('admin/etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etudiant_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Etudiant $etudiant
     * @return Response
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_index');
        }

        return $this->render('admin/etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_delete", methods={"POST"})
     * @param Request $request
     * @param Etudiant $etudiant
     * @return Response
     */
    public function delete(Request $request, Etudiant $etudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etudiant_index');
    }
}
