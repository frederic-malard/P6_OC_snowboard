<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FigureRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/{slug}", name="figure_affichage")
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
