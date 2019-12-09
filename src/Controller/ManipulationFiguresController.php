<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManipulationFiguresController extends AbstractController
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

            $fichiers = $form['illustrations']->getData();

            if($fichiers)
            {
                foreach ($fichiers as $fichier) {
                    $dossier = "illustrations";
                    $extension = $fichier->guessExtension();
                    if(!$extension)
                        $extension = "bin";
                    $nomFichier = rand(1, 999999999);
        
                    $fichier->move($dossier, $nomFichier . "." . $extension);
        
                    $user->addIllustration("/" . $dossier . "/" . $nomFichier . "." . $extension);
                }
            }

            $manager->persist($figure);
            $manager->flush();

            $this->addFlash("success", "Figure ajoutée avec succès");

            return $this->redirectToRoute("figure_affichage", [
                "slug" => $figure->getSlug()
            ]);
        }

        return $this->render('manipulationFigures/ajoutFigure.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{slug}", name="modifier_figure")
     * @Security("is_granted('ROLE_MODO') or (is_granted('ROLE_USER') and user === figure.getEditeur())")
     */
    public function modifierFigure(Figure $figure, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($figure);
            $manager->flush();

            $this->addFlash("success", "Figure modifiée avec succès");

            return $this->redirectToRoute("figure_affichage", [
                "slug" => $figure->getSlug()
            ]);
        }

        return $this->render('manipulationFigures/modificationFigure.html.twig', [
            "form" => $form->createView(),
            "figure" => $figure
        ]);
    }

    /**
     * @Route("/supprimer/{slug}", name="supprimer_figure")
     * @Security("is_granted('ROLE_MODO') or (is_granted('ROLE_USER') and user === figure.getEditeur())")
     */
    public function supprimerFigure(Figure $figure, ObjectManager $manager)
    {
        $commentaires = $figure->getCommentaires();
        $illustrations = $figure->getIllustrations();
        $videos = $figure->getVideos();
        
        foreach ($commentaires as $commentaire) {
            $manager->remove($commentaire);
        }
        foreach ($illustrations as $illustration) {
            $manager->remove($illustration);
        }
        foreach ($videos as $video) {
            $manager->remove($video);
        }

        $manager->remove($figure);

        $manager->flush();

        $this->addFlash("success", "Figure supprimée avec succès");

        return $this->redirectToRoute("accueil");
    }
}
