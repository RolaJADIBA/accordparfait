<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAccountController extends AbstractController
{
    /**
     * @Route("/user/account", name="user_account")
     */
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        
        return $this->render('user_account/index.html.twig', [
            'user' => $user,
            'users' => $userRepository->findAll()

        ]);
    }
    /**
     * @Route("/user/account/modifier", name="user_account_modifier")
     */
    public function modifier(Request $request)
    {
        $user = $this->getUser();

        $ancienne_photo = $user->getPhoto();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            if($user->getPhoto()) {
                if($ancienne_photo != null){
                    $filesystem= new Filesystem();
                    $filesystem->remove('images/user/' . $ancienne_photo);
                }
                $photo = $form->get('photo')->getData();
                $nouveau_nom = md5(uniqid()) .'.'. $photo->guessExtension();
                $photo->move(
                    $this->getParameter('image_user'),
                    $nouveau_nom
                );
                $user->setPhoto($nouveau_nom);
            }else{
                $user->setPhoto($ancienne_photo);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_account');
        }

        return $this->render('user_account/modifier.html.twig',[
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete")
     */
    public function delete(Request $request, User $user, User $id)
    {
        $ancienne_photo = $id->getPhoto();

        if($id->getPhoto()){
            $filesystem1 = new Filesystem();
            $filesystem1->remove('images/user/' . $ancienne_photo);
        }

        //Si $id n'est pas vide, on supprime la catégorie
        if($id){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash('success','La preparation est correctement supprimée');
        }        
        else{
            $this->addFlash('error', "La preparation n'existe pas");
        }       

        return $this->redirectToRoute('app_login');

    }

}
