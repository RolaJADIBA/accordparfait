<?php

namespace App\Controller;

use App\Entity\Jardin;
use App\Form\JardinType;
use App\Repository\JardinRepository;
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
class JardinController extends AbstractController
{
    /**
     * @Route("/jardin", name="jardin_index", methods={"GET"})
     */
    public function index(JardinRepository $jardinRepository): Response
    {
        return $this->render('admin/jardin/index.html.twig', [
            'jardins' => $jardinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/jardin/new", name="jardin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lists = [];

        $jardin = new Jardin();
        $form = $this->createForm(JardinType::class, $jardin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();

            foreach($images as $image){
                $nouveau_nom = md5(uniqid()).'.'.$image->guessExtension();

                //Récupère les informations du fichier
                $image->move(
                    $this->getParameter('image_jardin'),
                    $nouveau_nom
                );
                $lists[] = $nouveau_nom;
            }

            $jardin->setImages($lists);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jardin);
            $entityManager->flush();

            return $this->redirectToRoute('jardin_index');
        }

        return $this->render('admin/jardin/new.html.twig', [
            'jardin' => $jardin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/jardin/{id}", name="jardin_show", methods={"GET"})
     */
    public function show(Jardin $jardin): Response
    {
        return $this->render('admin/jardin/show.html.twig', [
            'jardin' => $jardin,
        ]);
    }

    /**
     * @Route("/jardin/{id}/edit", name="jardin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Jardin $id): Response
    {
        $ancienne_photos = [];
        $ancienne_photos = $id->getImages();

        $form = $this->createForm(JardinType::class, $id);
        $form->handleRequest($request);
        $lists = [];

        if ($form->isSubmitted() && $form->isValid()) {

            if($id->getImages()) {

                if($ancienne_photos != null){
                    // Supprime l'ancienne photo
                    $filesystem= new Filesystem();
    
                    foreach($ancienne_photos as $ancienne_photo){
    
                        $filesystem->remove('images/jardin/'. $ancienne_photo);
                    }
                    }
                    $images = $form->get('images')->getData();

                    foreach($images as $image){

                    $nouveau_nom = md5(uniqid()) .'.'. $image->guessExtension();

                    $image->move(
                        $this->getParameter('image_jardin'),
                        $nouveau_nom
                    );

                    $lists[] = $nouveau_nom;

                    $id->setImages($lists);
                }

            }else{
                $id->setImages($ancienne_photos);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jardin_index');
        }

        return $this->render('admin/jardin/edit.html.twig', [
            'jardin' => $id,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/jardin/delete/{id}", name="jardin_delete", methods={"POST"})
     */
    public function delete(Request $request, Jardin $jardin, Jardin $id): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$jardin->getId(), $request->request->get('_token'))) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($jardin);
        //     $entityManager->flush();
        // }

        $ancienne_photos = [];
        $ancienne_photos = $jardin->getImages();

        if($id->getImages()){

            $filesystem = new Filesystem();

            foreach($ancienne_photos as $ancienne_photo){

            $filesystem->remove('images/jardin/'. $ancienne_photo);

            }                    
        }

        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jardin);
            $entityManager->flush();

            $this->addFlash('success','Le jardin est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "Le jardin n'existe pas");
        }       

        return $this->redirectToRoute('jardin_index');
    }
}
