<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/ajout-figure", name="ajout_figure")
     */
    public function ajoutFigure()
    {
        return $this->render('utilisateur/ajoutFigure.html.twig', [
            
        ]);
    }
}
