<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/ajout-figure", name="ajout_figure")
     * @IsGranted("ROLE_USER")
     */
    public function ajoutFigure(Request $request, ObjectManager $manager)
    {
        $figure = new Figure();
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $figure->setEditeur($this->getUser());

            $manager->persist($figure);
            $manager->flush();

            $this->addFlash("success", "Figure ajoutée avec succès");

            return $this->redirectToRoute("figure_affichage", [
                "slug" => $figure->getSlug()
            ]);
        }

        return $this->render('utilisateur/ajoutFigure.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
