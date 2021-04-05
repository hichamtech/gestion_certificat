<?php

namespace App\Controller\admin;

use App\Entity\SousModule;
use App\Form\SousModuleType;
use App\Repository\SousModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/sous/module")
 */
class SousModuleController extends AbstractController
{
    /**
     * @Route("/", name="sous_module_index", methods={"GET"})
     */
    public function index(SousModuleRepository $sousModuleRepository): Response
    {
        return $this->render('admin/sous_module/index.html.twig', [
            'sous_modules' => $sousModuleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_module_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousModule = new SousModule();
        $form = $this->createForm(SousModuleType::class, $sousModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousModule);
            $entityManager->flush();

            return $this->redirectToRoute('sous_module_index');
        }

        return $this->render('admin/sous_module/new.html.twig', [
            'sous_module' => $sousModule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_module_show", methods={"GET"})
     */
    public function show(SousModule $sousModule): Response
    {
        return $this->render('admin/sous_module/show.html.twig', [
            'sous_module' => $sousModule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_module_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousModule $sousModule): Response
    {
        $form = $this->createForm(SousModuleType::class, $sousModule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_module_index');
        }

        return $this->render('admin/sous_module/edit.html.twig', [
            'sous_module' => $sousModule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_module_delete", methods={"POST"})
     */
    public function delete(Request $request, SousModule $sousModule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousModule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousModule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_module_index');
    }
}
