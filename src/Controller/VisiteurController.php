<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Difficulte;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FigureRepository;
use App\Repository\DifficulteRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
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
    public function affichage(Figure $figure, DifficulteRepository $difficulteRepo, Request $request, ObjectManager $manager)
    {
        $difficultes = $difficulteRepo->findByFigure($figure);
        $difficulteEditeur = null;
        $difficulteUtilisateurCourant = null;
        $utilisateurCourantEstEditeur = ($figure->getEditeur() == $this->getUser());
        $difficultesAutres = array();
        $nbAffichages = 0;
        $sommeSansEditeur = 0; // pour calculer la difficulté moyenne donnée par ceux qui ne sont pas l'éditeur
        $nbDifficultesSansEditeur = 0; // idem, les deux évoluent ci dessous

        if ($this->getUser() != null)
            $nbAffichages++;

        foreach ($difficultes as $difficulte)
        {
            // si la difficulté étudiée est celle donnée par l'utilisateur courant, qui se trouve aussi être l'éditeur de la figure
            if ($difficulte->getNotant() == $this->getUser() && $difficulte->getNotant() == $figure->getEditeur())
            {
                $difficulteUtilisateurCourant = $difficulte;
                $difficulteEditeur = $difficulte;
            } // si la difficulté étudiée est donnée par l'utilisateur courant, et qu'il n'est pas l'éditeur
            elseif ($difficulte->getNotant() == $this->getUser())
            {
                $difficulteUtilisateurCourant = $difficulte;
                $sommeSansEditeur += $difficulte->getNote();
                $nbDifficultesSansEditeur++;
            } // si la difficulté étudiée est donnée par l'éditeur, et qu'il n'est pas l'utilisateur courant
            elseif ($difficulte->getNotant() == $figure->getEditeur())
            {
                $difficulteEditeur = $difficulte;
                $nbAffichages++;
            }
            else // si la difficulté étudiée est donnée par quelqu'un qui n'est ni l'utilisateur courant, ni l'éditeur de la figure
            {
                if (count($difficultesAutres) == 0)
                {
                    $nbAffichages++;
                }
                $difficultesAutres[] = $difficulte;
                $sommeSansEditeur += $difficulte->getNote();
                $nbDifficultesSansEditeur++;
            }
        }

        if ($nbDifficultesSansEditeur == 0) {
            $difficulteMoyenneSansEditeur = null;
        }
        else {
            $difficulteMoyenneSansEditeur = round($sommeSansEditeur / $nbDifficultesSansEditeur);
        }

        $commentaire = new Commentaire();

        $commentaire->setAuteur($this->getUser())
                    ->setFigure($figure);

        $form = $this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($commentaire);
            $manager->flush();

            $this->addFlash("success", "Commentaire ajouté");
        }

        return $this->render('visiteur/affichage.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
            'difficulteEditeur' => $difficulteEditeur,
            'difficulteUtilisateurCourant' => $difficulteUtilisateurCourant,
            'difficultesAutres' => $difficultesAutres,
            'utilisateurCourantEstEditeur' => $utilisateurCourantEstEditeur,
            'difficultes' => $difficultes,
            'nbAffichages' => $nbAffichages,
            'difficulteMoyenneSansEditeur' => $difficulteMoyenneSansEditeur
        ]);
    }

    /**
     * @Route("/noter-difficulte/{note}/{slugFigure}/{slugUtilisateur}", name="noter_difficulte")
     */
    function noterDifficulte($note, $slugFigure, $slugUtilisateur, FigureRepository $figureRepo, UtilisateurRepository $utilisateurRepo, DifficulteRepository $difficulteRepo, ObjectManager $manager)
    {
        $figure = $figureRepo->findOneBySlug($slugFigure);
        $utilisateur = $utilisateurRepo->findOneBySlug($slugUtilisateur);

        $difficultesUtilisateur = $difficulteRepo->findByNotant($utilisateur);

        foreach ($difficultesUtilisateur as $difficulteUtilisateur) {
            if ($difficulteUtilisateur->getFigure()->getSlug() == $figure->getSlug()) {
                $manager->remove($difficulteUtilisateur);
            }
        }

        $difficulte = new Difficulte();

        $difficulte->setNote($note)
                   ->setNotant($utilisateur)
                   ->setFigure($figure);

        $manager->persist($difficulte);
        $manager->flush();

        $this->addFlash("success", "Figure notée");

        return $this->redirectToRoute("figure_affichage", [
            "slug" => $figure->getSlug()
        ]);
    }
}
