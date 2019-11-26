<?php

namespace App\Controller;

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
}
