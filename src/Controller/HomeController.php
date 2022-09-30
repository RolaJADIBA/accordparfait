<?php

namespace App\Controller;

use App\Entity\Autonomie;
use App\Form\ContactType;
use App\Repository\AutonomieRepository;
use App\Repository\ComplementRepository;
use App\Repository\DelfRepository;
use App\Repository\EvenementsRepository;
use App\Repository\JardinRepository;
use App\Repository\MobiliteRepository;
use App\Repository\NumeriqueRepository;
use App\Repository\SoutienRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementsRepository $evenementsRepository, Request $request,  MailerInterface $mailer): Response
    {
        $evenements = $evenementsRepository->findAll();

        $id = $request->get('id_eve');

        $evenement = $evenementsRepository->findBy(['id' => $id]);

        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('rola.zaitoni@gmail.com')
                ->subject('Merci pour votre inscription!')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'mail' => $contact->get('email')->getData(),
                    'message' => $contact->get('message')->getData()
                ]);
                $mailer->send($email);

                $this->addFlash('message', 'Votre e-mail a bien été envoyé');
                return $this->redirectToRoute('home');
        }

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('home/index.html.twig',[
                    'evenements' => $evenements,
                    'evenement' => $evenement
                ])
        
            ]);
        }

        return $this->render('home/index.html.twig',[
            'evenements' => $evenements,
            'evenement' => $evenement,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modal", name="modal")
     */
    public function modal(EvenementsRepository $evenementsRepository, Request $request)
    {
        $id = $request->get('id_eve');

        $evenement = $evenementsRepository->findBy(['id' => $id]);
        
        // dd($evenement);
        return $this->render('home/index.html.twig',[
            'evenement' => $evenement
        ]);
    }

    /******************************** ABOUT ****************************************** */
    /**
     * @Route("/about", name="about")
     */
    public function about(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('home/about.html.twig',[
            'users' => $users
        ]);
    }

    //////////////////////////////// AUTONOMOI /////////////////////////////////////////

    /**
     * @Route("/autonomie", name="autonomie")
     */
    public function autonomie(AutonomieRepository $autonomieRepository)
    {
        $autonomies = $autonomieRepository->findAll();

        return $this->render("home/autonomie.html.twig",[
            'autonomies' => $autonomies
        ]);
    }

    /////////////////////////// Complément Linguistique /////////////////////////////////////
    /**
     * @Route("/complement", name="complement")
     */
    public function complement(ComplementRepository $complementRepository)
    {
        $complements = $complementRepository->findAll();

        return $this->render("home/complement.html.twig",[
            'complements' => $complements
        ]);
    }
    /////////////////////////// Préparation au DELF /////////////////////////////////////
    /**
     * @Route("/delf", name="delf")
     */
    public function delf(DelfRepository $delfRepository)
    {
        $delvs = $delfRepository->findAll();

        return $this->render("home/delf.html.twig",[
            'delvs' => $delvs
        ]);
    }
    //////////////////////////// MOBILITE //////////////////////////////////////////////

    /**
     * @Route("/mobilite", name="mobilite")
     */
    public function mobilite(MobiliteRepository $mobiliteRepository)
    {
        $mobilites = $mobiliteRepository->findAll();

        return $this->render("home/mobilite.html.twig",[
            'mobilites' => $mobilites
        ]);
    }
    ///////////////////////////// Inclusion Numérique ////////////////////////////////////
    /**
     * @Route("/numerique", name="numerique")
     */
    public function numerique(NumeriqueRepository $numeriqueRepository)
    {
        $numeriques = $numeriqueRepository->findAll();

        return $this->render("home/numerique.html.twig",[
            'numeriques' =>$numeriques
        ]);
    }
    ///////////////////////////// Jardin Solidaire ////////////////////////////////////
    /**
     * @Route("/jardin", name="jardin")
     */
    public function jardin(JardinRepository $jardinRepository)
    {
        return $this->render("home/jardin.html.twig",[
            'jardins' => $jardinRepository->findAll()
        ]);
    }
    //////////////////// Soutien aux familles et à la parentalité /////////////////////////////
    /**
     * @Route("/soutien", name="soutien")
     */
    public function soutien(SoutienRepository $soutienRepository)
    {
        return $this->render("home/soutien.html.twig",[
            'soutiens' => $soutienRepository->findAll()
        ]);
    }
    //////////////////// NOS EVENEMENTS ////////////////////////////////////////
    /**
     * @Route("/evenement", name="evenement")
     */
    public function evenement(EvenementsRepository $evenementsRepository)
    {
        $evenements = $evenementsRepository->findAll();

        return $this->render("home/evenement.html.twig",[
            'evenements' => $evenements
        ]);
    }

        /**
     * @Route("/evenement/details/{id}", name="evenement_details")
     */
    public function evenementDetails(EvenementsRepository $evenementsRepository, $id, SerializerInterface $serializer)
    {
        $evenement = $evenementsRepository->find($id);
        // $evenementJson = $serializer->serialize($evenement, 'json');
        // return new JsonResponse(array('data' => $evenementJson), 200);
        return $this->json($evenement);
    }
}
