<?php

namespace App\Controller;

use App\Entity\Mobilite;
use App\Form\MobiliteType;
use App\Repository\MobiliteRepository;
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
class MobiliteController extends AbstractController
{
    /**
     * @Route("/mobilite", name="mobilite_index", methods={"GET"})
     */
    public function index(MobiliteRepository $mobiliteRepository): Response
    {
        return $this->render('admin/mobilite/index.html.twig', [
            'mobilites' => $mobiliteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/mobilite/new", name="mobilite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $mobilite = new Mobilite();
        $form = $this->createForm(MobiliteType::class, $mobilite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('Images')->getData();

            foreach($images as $image){
                $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

                //Récupère les informations du fichier
                $image->move(
                    $this->getParameter('image_mobilite'),
                    $nouveau_nom
                );
                $lists[] = $nouveau_nom;
            }

            $mobilite->setImages($lists);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mobilite);
            $entityManager->flush();

            return $this->redirectToRoute('mobilite_index');
        }

        return $this->render('admin/mobilite/new.html.twig', [
            'mobilite' => $mobilite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mobilite/{id}", name="mobilite_show", methods={"GET"})
     */
    public function show(Mobilite $mobilite): Response
    {
        return $this->render('admin/mobilite/show.html.twig', [
            'mobilite' => $mobilite,
        ]);
    }

    /**
     * @Route("/mobilite/{id}/edit", name="mobilite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mobilite $id): Response
    {
        $ancienne_photos = [];
        $ancienne_photos = $id->getImages();

        $form = $this->createForm(MobiliteType::class, $id);
        $form->handleRequest($request);
        $lists = [];

        if ($form->isSubmitted() && $form->isValid()) {

            if($id->getImages()) {

                if($ancienne_photos != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();
    
                    foreach($ancienne_photos as $ancienne_photo){
    
                        $filesystem->remove('images/mobilite/'. $ancienne_photo);
                    }
                    }
                    $images = $form->get('Images')->getData();

                    foreach($images as $image){

                    $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                    $image->move(
                        $this->getParameter('image_mobilite'),
                        $nouveau_nom
                    );

                    $lists[] = $nouveau_nom;

                    $id->setImages($lists);
                }

            }else{
                $id->setImages($ancienne_photos);
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mobilite_index');
        }

        return $this->render('admin/mobilite/edit.html.twig', [
            'mobilite' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mobilite/delete/{id}", name="mobilite_delete", methods={"POST"})
     */
    public function delete(Request $request, Mobilite $mobilite, Mobilite $id): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$mobilite->getId(), $request->request->get('_token'))) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($mobilite);
        //     $entityManager->flush();
        // }
        $ancienne_photos = [];
        $ancienne_photos = $mobilite->getImages();

        if($id->getImages()){

            $filesystem = new Filesystem();

            foreach($ancienne_photos as $ancienne_photo){

            $filesystem->remove('images/mobilite/'. $ancienne_photo);

            }                    
        }

        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mobilite);
            $entityManager->flush();

            $this->addFlash('success','Le mobilité est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "Le mobilité n'existe pas");
        }       
        return $this->redirectToRoute('mobilite_index');
    }
}
