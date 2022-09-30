<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request,  MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('coordination@laccord-parfait.fr')
                ->subject($contact->get('title')->getData())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'title' => $contact->get('title')->getData(),
                    'mail' => $contact->get('email')->getData(),
                    'message' => $contact->get('message')->getData()
                ]);
                $mailer->send($email);

                $this->addFlash('message', 'Votre e-mail a bien été envoyé');
                return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
