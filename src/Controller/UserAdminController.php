<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class UserAdminController extends AbstractController
{
    /**
     * @Route("/user/admin", name="user_admin")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user_admin/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/activer/{id}", name="user_activer")
     */
    public function activer(User $user)
    {
        $user->setActive($user->getActive() ? false: true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('true');
    }

}
