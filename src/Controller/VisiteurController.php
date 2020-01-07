<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Difficulte;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use App\Form\CommentaireType;
use App\Repository\FigureRepository;
use App\Repository\GroupeRepository;
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
    public function accueil(FigureRepository $repoFigures, GroupeRepository $repoGroupes)
    {
        $figures = $repoFigures->findAll();
        $groupes = $repoGroupes->findAll();

        return $this->render('visiteur/accueil.html.twig', [
            'figures' => $figures,
            'groupes' => $groupes
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
     * @Route("/verification-mail", name="verification_mail")
     */
    public function verificationMail()
    {
        return $this->render("visiteur/verificationMail.html.twig");
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    { // 'This method can be blank - it will be intercepted by the logout key on your firewall'
        throw new \Exception();
    }

    /**
     * @Route("/figures/{slug}", name="figure_affichage")
     */
    public function affichage(Figure $figure, DifficulteRepository $difficulteRepo, Request $request, ObjectManager $manager)
    {
        // préparation variables pour twig
        $difficulteEditeur = $figure->getDifficulteEditeur();
        $difficulteUtilisateurCourant = $figure->getDifficulteUtilisateur($this->getUser());
        $utilisateurCourantEstEditeur = ($figure->getEditeur() == $this->getUser());
        $nbAffichages = $figure->nbAffichagesDifficulte($this->getUser());
        $difficulteMoyenneSansEditeur = $figure->getDifficulteMoyenneSansEditeur();
        $couleurTitreDifficulte = $figure->couleurTitreDifficulte();

        // préparation du formulaire de commentaire
        $commentaire = new Commentaire();

        $commentaire->setAuteur($this->getUser())
                    ->setFigure($figure);

        $form = $this->createForm(CommentaireType::class, $commentaire);

        // traitement des données éventuelles du formulaire de commentaire
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
            'utilisateurCourantEstEditeur' => $utilisateurCourantEstEditeur,
            'nbAffichages' => $nbAffichages,
            'difficulteMoyenneSansEditeur' => $difficulteMoyenneSansEditeur,
            'couleur' => $couleurTitreDifficulte
        ]);
    }

    /**
     * Note : le paramètre "note" doit rester à la fin, car ajouté par concaténation manuellement dans appExtension
     * 
     * @Route("/noter-difficulte/{slugFigure}/{slugUtilisateur}/{note}", name="noter_difficulte")
     */
    function noterDifficulte($note, $slugFigure, $slugUtilisateur, FigureRepository $figureRepo, UtilisateurRepository $utilisateurRepo, DifficulteRepository $difficulteRepo, ObjectManager $manager)
    {
        $figure = $figureRepo->findOneBySlug($slugFigure);
        $utilisateur = $utilisateurRepo->findOneBySlug($slugUtilisateur);

        $difficultesUtilisateur = $difficulteRepo->findByNotant($utilisateur);

        foreach ($difficultesUtilisateur as $difficulteUtilisateur)
        {
            if ($difficulteUtilisateur->getFigure()->getSlug() == $figure->getSlug())
            {
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

    /**
     * @Route("ajouter-favoris/{slugUtilisateur}/{slugFigure}", name="ajout_favoris")
     */
    public function ajoutFavoris($slugUtilisateur, $slugFigure, UtilisateurRepository $utilisateurRepository, FigureRepository $figureRepository, ObjectManager $manager)
    {
        $utilisateur = $utilisateurRepository->findOneBySlug($slugUtilisateur);
        $figure = $figureRepository->findOneBySlug($slugFigure);

        $utilisateur->addFavori($figure);
        $figure->addInteress($utilisateur);

        $manager->persist($utilisateur);
        $manager->persist($figure);

        $manager->flush();

        $this->addFlash("success", "Figure ajoutée aux favorites");

        return $this->redirectToRoute("figure_affichage", [
            "slug" => $figure->getSlug()
        ]);
    }

    /**
     * @Route("liste-favorites/{slug}", name="liste_favorites")
     */
    public function listeFavorites(Utilisateur $utilisateur)
    {
        $favorites = $utilisateur->getFavoris();

        return $this->render("visiteur/listeUtilisateur.html.twig", [
            "utilisateur" => $utilisateur,
            "favorites" => $favorites
        ]);
    }

    /**
     * @Route("liste-figures-persos/{slug}", name="liste_figures_persos")
     */
    public function listeFiguresPersos(Utilisateur $utilisateur)
    {
        $figures = $utilisateur->getFigures();

        return $this->render("visiteur/listeFiguresPersos.html.twig", [
            "utilisateur" => $utilisateur,
            "figures" => $figures
        ]);
    }
}
