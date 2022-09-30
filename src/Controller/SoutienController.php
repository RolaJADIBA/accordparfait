<?php

namespace App\Controller;

use App\Entity\Soutien;
use App\Form\SoutienType;
use App\Repository\SoutienRepository;
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
class SoutienController extends AbstractController
{
    /**
     * @Route("/soutien", name="soutien_index", methods={"GET"})
     */
    public function index(SoutienRepository $soutienRepository): Response
    {
        return $this->render('admin/soutien/index.html.twig', [
            'soutiens' => $soutienRepository->findAll(),
        ]);
    }

    /**
     * @Route("/soutien/new", name="soutien_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $soutien = new Soutien();
        $form = $this->createForm(SoutienType::class, $soutien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();

            foreach($images as $image){
                $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

                //Récupère les informations du fichier
                $image->move(
                    $this->getParameter('image_soutien'),
                    $nouveau_nom
                );
                $lists[] = $nouveau_nom;
            }

            $soutien->setImages($lists);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soutien);
            $entityManager->flush();

            return $this->redirectToRoute('soutien_index');
        }

        return $this->render('admin/soutien/new.html.twig', [
            'soutien' => $soutien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/soutien/{id}", name="soutien_show", methods={"GET"})
     */
    public function show(Soutien $soutien): Response
    {
        return $this->render('admin/soutien/show.html.twig', [
            'soutien' => $soutien,
        ]);
    }

    /**
     * @Route("/soutien/{id}/edit", name="soutien_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Soutien $id): Response
    {
        $ancienne_photos = [];
        $ancienne_photos = $id->getImages();


        $form = $this->createForm(SoutienType::class, $id);
        $form->handleRequest($request);
        $lists = [];

        if ($form->isSubmitted() && $form->isValid()) {

            if($id->getImages()) {

                if($ancienne_photos != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();
    
                    foreach($ancienne_photos as $ancienne_photo){
    
                        $filesystem->remove('images/soutien/'. $ancienne_photo);
                    }
                    }
                    $images = $form->get('images')->getData();

                    foreach($images as $image){

                    $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                    $image->move(
                        $this->getParameter('image_soutien'),
                        $nouveau_nom
                    );

                    $lists[] = $nouveau_nom;

                    $id->setImages($lists);
                }

            }else{
                $id->setImages($ancienne_photos);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soutien_index');
        }

        return $this->render('admin/soutien/edit.html.twig', [
            'soutien' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/soutien/delete/{id}", name="soutien_delete", methods={"POST"})
     */
    public function delete(Request $request, Soutien $soutien, Soutien $id): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$soutien->getId(), $request->request->get('_token'))) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($soutien);
        //     $entityManager->flush();
        // }
        $ancienne_photos = [];
        $ancienne_photos = $soutien->getImages();

        if($id->getImages()){

            $filesystem = new Filesystem();

            foreach($ancienne_photos as $ancienne_photo){

            $filesystem->remove('images/soutien/'. $ancienne_photo);

            }                    
        }

        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soutien);
            $entityManager->flush();

            $this->addFlash('success','Le soutien est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "Le soutien n'existe pas");
        }       

        return $this->redirectToRoute('soutien_index');
    }
}
