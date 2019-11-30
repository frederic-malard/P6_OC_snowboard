<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FigureRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(FigureRepository $repoFigures)
    {
        $figures = $repoFigures->findAll();

        return $this->render('visiteur/accueil.html.twig', [
            'figures' => $figures
        ]);
    }

    /**
     * @Route("/connexion", name="connexion", methods={"GET", "POST"})
     */
    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('visiteur/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/figures/{slug}", name="figure_affichage")
     */
    public function affichage(Figure $figure, Request $request, ObjectManager $manager, UtilisateurRepository $repo)
    {
        $commentaire = new Commentaire();

        // A EFFACER PLUS TARD !!! En attendant la gestion des comptes
        $utilisateur = $repo->findOneByLogin("earum2219");

        $commentaire->setAuteur($utilisateur)
                    ->setFigure($figure);

        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($commentaire);
            $manager->flush();
        }

        return $this->render('visiteur/affichage.html.twig', [
            'figure' => $figure,
            'form' => $form->createView()
        ]);
    }
}
