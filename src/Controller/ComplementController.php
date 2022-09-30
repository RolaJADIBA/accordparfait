<?php

namespace App\Controller;

use App\Entity\Complement;
use App\Form\ComplementType;
use App\Repository\ComplementRepository;
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
class ComplementController extends AbstractController
{
    /**
     * @Route("/complement", name="complement_index", methods={"GET"})
     */
    public function index(ComplementRepository $complementRepository): Response
    {
        return $this->render('admin/complement/index.html.twig', [
            'complements' => $complementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/complement/new", name="complement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $complement = new Complement();
        $form = $this->createForm(ComplementType::class, $complement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();

            foreach($images as $image){
                $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

                //Récupère les informations du fichier
                $image->move(
                    $this->getParameter('image_complement'),
                    $nouveau_nom
                );
                $lists[] = $nouveau_nom;
            }

            $complement->setImages($lists);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($complement);
            $entityManager->flush();

            return $this->redirectToRoute('complement_index');
        }

        return $this->render('admin/complement/new.html.twig', [
            'complement' => $complement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/complement/{id}", name="complement_show", methods={"GET"})
     */
    public function show(Complement $complement): Response
    {
        return $this->render('admin/complement/show.html.twig', [
            'complement' => $complement,
        ]);
    }

    /**
     * @Route("/complement/{id}/edit", name="complement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Complement $id): Response
    {
        $ancienne_photos = [];
        $ancienne_photos = $id->getImages();

        $form = $this->createForm(ComplementType::class, $id);
        $form->handleRequest($request);
        $lists = [];

        if ($form->isSubmitted() && $form->isValid()) {

            if($id->getImages()) {

                if($ancienne_photos != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();
    
                    foreach($ancienne_photos as $ancienne_photo){
    
                        $filesystem->remove('images/complement/'. $ancienne_photo);
                    }
                    }
                    $images = $form->get('images')->getData();

                    foreach($images as $image){

                    $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                    $image->move(
                        $this->getParameter('image_complement'),
                        $nouveau_nom
                    );

                    $lists[] = $nouveau_nom;

                    $id->setImages($lists);
                }

            }else{
                $id->setImages($ancienne_photos);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('complement_index');
        }

        return $this->render('admin/complement/edit.html.twig', [
            'complement' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/complement/delete/{id}", name="complement_delete", methods={"POST"})
     */
    public function delete(Request $request, Complement $complement, Complement $id): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$complement->getId(), $request->request->get('_token'))) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($complement);
        //     $entityManager->flush();
        // }
        $ancienne_photos = [];
        $ancienne_photos = $complement->getImages();

        if($id->getImages()){

            $filesystem = new Filesystem();

            foreach($ancienne_photos as $ancienne_photo){

            $filesystem->remove('images/complement/'. $ancienne_photo);

            }                    
        }

        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($complement);
            $entityManager->flush();

            $this->addFlash('success','Le jardin est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "Le jardin n'existe pas");
        }       

        return $this->redirectToRoute('complement_index');
    }
}
