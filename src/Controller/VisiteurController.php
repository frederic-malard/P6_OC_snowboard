<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Repository\FigureRepository;
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
    public function affichage(Figure $figure)
    {
        

        return $this->render('visiteur/affichage.html.twig', [
            'figure' => $figure
        ]);
    }
}
