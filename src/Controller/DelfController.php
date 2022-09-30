<?php

namespace App\Controller;

use App\Entity\Delf;
use App\Form\DelfType;
use App\Repository\DelfRepository;
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
class DelfController extends AbstractController
{
    /**
     * @Route("/delf", name="delf_index", methods={"GET"})
     */
    public function index(DelfRepository $delfRepository): Response
    {
        return $this->render('admin/delf/index.html.twig', [
            'delves' => $delfRepository->findAll(),
        ]);
    }

    /**
     * @Route("/delf/new", name="delf_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $delf = new Delf();
        $form = $this->createForm(DelfType::class, $delf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('image_delf'),
                $nouveau_nom
            );

            $delf->setImage($nouveau_nom);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($delf);
            $entityManager->flush();

            return $this->redirectToRoute('delf_index');
        }

        return $this->render('admin/delf/new.html.twig', [
            'delf' => $delf,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delf/{id}", name="delf_show", methods={"GET"})
     */
    public function show(Delf $delf): Response
    {
        return $this->render('admin/delf/show.html.twig', [
            'delf' => $delf,
        ]);
    }

    /**
     * @Route("/delf/{id}/edit", name="delf_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Delf $id): Response
    {
        $ancienne_photo = $id->getImage();

        $form = $this->createForm(DelfType::class, $id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($id->getImage()) {
                if($ancienne_photo != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();

                    $filesystem->remove('images/delf/' . $ancienne_photo);
                }
                $image = $form->get('image')->getData();

                $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                $image->move(
                    $this->getParameter('image_delf'),
                    $nouveau_nom
                );
                $id->setImage($nouveau_nom);
            }else{
                $id->setImage($ancienne_photo);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delf_index');
        }

        return $this->render('admin/delf/edit.html.twig', [
            'delf' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delf/delete/{id}", name="delf_delete", methods={"POST"})
     */
    public function delete(Request $request, Delf $id, Delf $delf): Response
    {
        $ancienne_photo = $id->getImage();

        if($id->getImage()){
            $filesystem1 = new Filesystem();
            $filesystem1->remove('images/delf/' . $ancienne_photo);
        }
        //Si $id n'est pas vide, on supprime la catégorie
        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($delf);
            $entityManager->flush();

            $this->addFlash('success','La preparation est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "La preparation n'existe pas");
        }       

        return $this->redirectToRoute('delf_index');
    }
}
