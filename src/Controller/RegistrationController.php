<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\AppUtilisateurAuthAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppUtilisateurAuthAuthenticator $authenticator, \Swift_Mailer $mailer): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setMotDePasse(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('votreMotDePasse')->getData()
                )
            );

            $fichier = $form['attachment']->getData();

            if($fichier)
            {
                $dossier = "avatars";
                $extension = $fichier->guessExtension();
                if(!$extension)
                    $extension = "bin";
                $nomFichier = rand(1, 999999999);
    
                $fichier->move($dossier, $nomFichier . "." . $extension);
    
                $user->setAvatar("/" . $dossier . "/" . $nomFichier . "." . $extension);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // envoie de l'email de confirmation

            $message = (new \Swift_Message("Inscription Snowtricks"))
                ->setFrom("frederic.malard.pro@gmail.com")
                ->setTo($user->getMail())
                ->setBody(
                    $this->renderView(
                        "registration/mail.html.twig",
                        [
                            "utilisateur" => $user
                        ]
                    ),
                    "text/html"
                )
                ->addPart(
                    $this->renderView(
                        "registration/mail.txt.twig",
                        [
                            "utilisateur" => $user
                        ]
                    ),
                    "text/plain"
                )
            ;

            $mailer->send($message);

            //dump($user->getMail());
            //die();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
