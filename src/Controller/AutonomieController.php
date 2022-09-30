<?php

namespace App\Controller;

use App\Entity\Autonomie;
use App\Form\AutonomieType;
use App\Repository\AutonomieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AutonomieController extends AbstractController
{
    /**
     * @Route("/autonomie", name="autonomie_index", methods={"GET"})
     */
    public function index(AutonomieRepository $autonomieRepository): Response
    {
        return $this->render('admin/autonomie/index.html.twig', [
            'autonomies' => $autonomieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/autonomie/new", name="autonomie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $autonomie = new Autonomie();
        $form = $this->createForm(AutonomieType::class, $autonomie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($autonomie);
            $entityManager->flush();

            return $this->redirectToRoute('autonomie_index');
        }

        return $this->render('admin/autonomie/new.html.twig', [
            'autonomie' => $autonomie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/autonomie/{id}", name="autonomie_show", methods={"GET"})
     */
    public function show(Autonomie $autonomie): Response
    {
        return $this->render('admin/autonomie/show.html.twig', [
            'autonomie' => $autonomie,
        ]);
    }

    /**
     * @Route("/autonomie/{id}/edit", name="autonomie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Autonomie $autonomie): Response
    {
        $form = $this->createForm(AutonomieType::class, $autonomie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autonomie_index');
        }

        return $this->render('admin/autonomie/edit.html.twig', [
            'autonomie' => $autonomie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/autonomie/delete/{id}", name="autonomie_delete", methods={"POST"})
     */
    public function delete(Request $request, Autonomie $autonomie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autonomie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autonomie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autonomie_index');
    }
}
