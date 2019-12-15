<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionComptesController extends AbstractController
{
    /**
     * @Route("/gestion-utilisateurs", name="gestion_utilisateurs")
     * @IsGranted("ROLE_MODO")
     */
    public function gestionUtilisateurs(UtilisateurRepository $repo)
    {
        $utilisateurs = $repo->findByRole("utilisateur");
    
        return $this->render('gestionComptes/gestionUtilisateurs.html.twig', [
            "utilisateurs" => $utilisateurs
        ]);
    }
    
    /**
     * @Route("/gestion-moderateurs", name="gestion_moderateurs")
     * @IsGranted("ROLE_ADMIN")
     */
    public function gestionModerateurs(UtilisateurRepository $repo)
    {
        $moderateurs = $repo->findByRole("moderateur");
    
        return $this->render('gestionComptes/gestionModerateurs.html.twig', [
            "moderateurs" => $moderateurs
        ]);
    }
    
    /**
     * @Route("/suppression-utilisateur/{slug}", name="suppression_utilisateur")
     * @IsGranted("ROLE_MODO")
     */
    public function suppressionUtilisateur(Utilisateur $utilisateur, ObjectManager $manager, \Swift_Mailer $mailer)
    {
        $figures = $utilisateur->getFigures();
        $commentaires = $utilisateur->getCommentaires();

        foreach ($figures as $figure) {
            $figure->setEditeur(null);
        }
        foreach ($commentaires as $commentaire) {
            $manager->remove($commentaire);
        }

        $manager->remove($utilisateur);

        $manager->flush();

        $this->addFlash("success", "Utilisateur supprimé");

        $message = (new \Swift_Message("Compte snowtricks supprimé"))
                ->setFrom("frederic.malard.pro@gmail.com")
                ->setTo($utilisateur->getMail())
                ->setBody(
                    $this->renderView(
                        "gestionComptes/mailSuppression.html.twig",
                        [
                            "utilisateur" => $utilisateur
                        ]
                    ),
                    "text/html"
                )
                ->addPart(
                    $this->renderView(
                        "gestionComptes/mailSuppression.txt.twig",
                        [
                            "utilisateur" => $utilisateur
                        ]
                    ),
                    "text/plain"
                )
            ;

            $mailer->send($message);
    
        return $this->redirectToRoute('gestion_utilisateurs');
    }
    
    /**
     * @Route("/suppression-compte-perso/{slug}", name="suppression_compte_perso")
     * @Security("is_granted('ROLE_USER') and user === utilisateur")
     */
    public function suppressionComptePerso(Utilisateur $utilisateur, ObjectManager $manager, UtilisateurRepository $repo)
    {
        if($utilisateur->getRole() == "administrateur")
        {
            $admins = $repo->findByRole("administrateur");
            if(count($admins) <= 1)
            {
                $this->addFlash("danger", "Votre compte ne peut être supprimé car vous êtes le seul administrateur. Si vous ne voulez plus l'être, veuillez nommer quelqu'un d'autre administrateur. Vous pourrez alors supprimer votre compte, ou repasser simple modérateur.");

                return $this->redirectToRoute("accueil");
            }
        }

        $figures = $utilisateur->getFigures();
        $commentaires = $utilisateur->getCommentaires();
        $difficultes = $utilisateur->getDifficultes();

        foreach ($figures as $figure) {
            $figure->setEditeur(null);
        }
        foreach ($commentaires as $commentaire) {
            $manager->remove($commentaire);
        }
        foreach ($difficultes as $difficulte) {
            $manager->remove($difficulte);
        }

        $manager->remove($utilisateur);

        $manager->flush();

        $this->addFlash("success", "Votre compte a bien été supprimé");
        
        $session = $this->get('session');
        $session = new Session();
        $session->invalidate();
    
        return $this->redirectToRoute('accueil');
    }
    
    /**
     * @Route("/promotion-moderateur/{slug}", name="promotion_moderateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function promotionModerateur(Utilisateur $utilisateur, ObjectManager $manager)
    {
        $utilisateur->setRole("moderateur");

        $manager->persist($utilisateur);

        $manager->flush();

        $this->addFlash("success", "Utilisateur promut modérateur");
        
        return $this->redirectToRoute('gestion_utilisateurs');
    }
    
    /**
     * @Route("/perte-statut-moderateur/{slug}", name="perte_statut_moderateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function perteStatutModerateur(Utilisateur $moderateur, ObjectManager $manager)
    {
        $moderateur->setRole("utilisateur");
        
        $manager->persist($moderateur);
        
        $manager->flush();

        $this->addFlash("success", "Modérateur repassé simple utilisateur");
        
        return $this->redirectToRoute('gestion_moderateurs');
    }
    
    /**
     * @Route("/perte-statut-administrateur/{slug}", name="perte_statut_administrateur")
     * @Security("is_granted('ROLE_ADMIN') and user === administrateur")
     */
    public function perteStatutAdministrateur(Utilisateur $administrateur, ObjectManager $manager, UtilisateurRepository $repo)
    {
        if($administrateur->getRole() == "administrateur")
        {
            $admins = $repo->findByRole("administrateur");
            if(count($admins) <= 1)
            {
                $this->addFlash("danger", "Vous ne pouvez pas perdre votre statut d'administrateur, car vous êtes le seul administrateur restant. Si vous ne voulez plus l'être, veuillez nommer quelqu'un d'autre administrateur. Vous pourrez alors repasser simple modérateur, ou supprimer votre compte.");

                return $this->redirectToRoute("accueil");
            }
        }

        $administrateur->setRole("moderateur");
        
        $manager->persist($administrateur);
        
        $manager->flush();

        $this->addFlash("success", "Administrateur repassé simple modérateur");
        
        return $this->redirectToRoute('accueil');
    }
    
    /**
     * @Route("/promotion-administrateur/{slug}", name="promotion_administrateur")
     * @IsGranted("ROLE_ADMIN")
     */
    public function promotionAdministrateur(Utilisateur $moderateur, ObjectManager $manager)
    {
        $moderateur->setRole("administrateur");
    
        $manager->persist($moderateur);
    
        $manager->flush();

        $this->addFlash("success", "Modérateur promut administrateur");
        
        return $this->redirectToRoute('gestion_moderateurs');
    }
}
