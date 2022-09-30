<?php

namespace App\Controller;

use App\Entity\Evenements;
use App\Form\EvenementsType;
use App\Repository\EvenementsRepository;
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
class EvenementsController extends AbstractController
{
    /**
     * @Route("/evenements", name="evenements_index", methods={"GET"})
     */
    public function index(EvenementsRepository $evenementsRepository): Response
    {
        return $this->render('admin/evenements/index.html.twig', [
            'evenements' => $evenementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/evenements/new", name="evenements_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $evenement = new Evenements();
        $form = $this->createForm(EvenementsType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();
            $image_choisi = $form->get('image_choisi')->getData();

            foreach($images as $image){
                $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

                //Récupère les informations du fichier
                $image->move(
                    $this->getParameter('image_evenements'),
                    $nouveau_nom
                );
                $lists[] = $nouveau_nom;
            }

            $nouveau_nom_choisi = md5(uniqid()).'.'.$image_choisi->guessExtension();

            $image_choisi->move(
                $this->getParameter('image_choisi'),
                $nouveau_nom_choisi
            );

            $evenement->setImageChoisi($nouveau_nom_choisi);

            $evenement->setImages($lists);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenements_index');
        }

        return $this->render('admin/evenements/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/evenements/{id}", name="evenements_show", methods={"GET"})
     */
    public function show(Evenements $evenement): Response
    {
        return $this->render('admin/evenements/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/evenements/{id}/edit", name="evenements_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenements $id): Response
    {
        $ancienne_photos = [];
        $ancienne_photos = $id->getImages();
        $ancienne_photo_choisi = $id->getImageChoisi();

        $form = $this->createForm(EvenementsType::class, $id);
        $form->handleRequest($request);
        $lists = [];

        if ($form->isSubmitted() && $form->isValid()) {

            // Si getImage() est non null, on modifie la photo
            if($id->getImages()) {

                if($ancienne_photos != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();
    
                    foreach($ancienne_photos as $ancienne_photo){
    
                        $filesystem->remove('images/evenements/'. $ancienne_photo);
                    }
                    }

                    $images = $form->get('images')->getData();

                    foreach($images as $image){

                    $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                    $image->move(
                        $this->getParameter('image_evenements'),
                        $nouveau_nom
                    );

                    $lists[] = $nouveau_nom;
                    
                    $id->setImages($lists);
                } 

                }else{
                    $id->setImages($ancienne_photos);
                }
        
                if($id->getImageChoisi()){

                    if($ancienne_photo_choisi != null){
        
                        $filesystem1= new Filesystem();
        
                        $filesystem1->remove('images/image_choisi/' . $ancienne_photo_choisi);
                    }
                        $image_choisi = $form->get('image_choisi')->getData();
        
                        $nouveau_nom_choisi = md5(uniqid()) .'.'. $image_choisi->guessExtension();
        
                        $image_choisi->move(
                            $this->getParameter('image_choisi'),
                            $nouveau_nom_choisi
                        );
            
                        $id->setImageChoisi($nouveau_nom_choisi);
        
                    }else{
                        $id->setImageChoisi($ancienne_photo_choisi);
                    }
        

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenements_index');
        }

        return $this->render('admin/evenements/edit.html.twig', [
            'evenement' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/evenements/delete/{id}", name="evenements_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenements $evenements, Evenements $id): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($evenement);
        //     $entityManager->flush();
        // }

        $ancienne_photos = [];
        $ancienne_photos = $evenements->getImages();
        $ancienne_photo_choisi = $evenements->getImageChoisi();

        if($id->getImages()){

            $filesystem = new Filesystem();

            foreach($ancienne_photos as $ancienne_photo){

            $filesystem->remove('images/evenements/'. $ancienne_photo);

                }                    
            }

            if($id->getImageChoisi()){

                $filesystem1 = new Filesystem();
                $filesystem1->remove('images/image_choisi/' . $ancienne_photo_choisi);

            }
        //Si $id n'est pas vide, on supprime la catégorie
        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenements);
            $entityManager->flush();

            $this->addFlash('success','L\'evenement est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "L\'evenement n'existe pas");
        }       


        return $this->redirectToRoute('evenements_index');
    }

    /**
     * @Route("/evenements/activer/{id}", name="activer")
     */
    public function activer(Evenements $evenement)
    {
        $evenement->setActive($evenement->getActive() ? false: true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($evenement);
        $entityManager->flush();

        return new Response('true');
    }
}
