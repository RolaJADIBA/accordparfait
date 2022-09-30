<?php

namespace App\Controller;

use App\Entity\Numerique;
use App\Entity\NumeriqueImage;
use App\Form\NumeriqueImageType;
use App\Form\NumeriqueType;
use App\Repository\NumeriqueImageRepository;
use App\Repository\NumeriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class NumeriqueController extends AbstractController
{
    /**
     * @Route("/numerique", name="numerique_index", methods={"GET"})
     */
    public function index(NumeriqueRepository $numeriqueRepository): Response
    {
        return $this->render('admin/numerique/index.html.twig', [
            'numeriques' => $numeriqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/numerique/new", name="numerique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $numerique = new Numerique();
        $form = $this->createForm(NumeriqueType::class, $numerique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($numerique);
            $entityManager->flush();

            return $this->redirectToRoute('numerique_index');
        }

        return $this->render('admin/numerique/new.html.twig', [
            'numerique' => $numerique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/numerique/{id}", name="numerique_show", methods={"GET"})
     */
    public function show(Numerique $numerique): Response
    {
        return $this->render('admin/numerique/show.html.twig', [
            'numerique' => $numerique,
        ]);
    }

    /**
     * @Route("/numerique/{id}/edit", name="numerique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Numerique $id): Response
    {
        $form = $this->createForm(NumeriqueType::class, $id);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('numerique_index');
        }

        return $this->render('admin/numerique/edit.html.twig', [
            'numerique' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/numerique/delete/{id}", name="numerique_delete", methods={"POST"})
     */
    public function delete(Request $request, Numerique $numerique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numerique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($numerique);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('numerique_index');
    }
}
