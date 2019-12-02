<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionCommentairesController extends AbstractController
{
    /**
     * @Route("/signaler-commentaire/{slug}/{idCommentaire}", name="signaler_commentaire")
     */
    public function signalerCommentaire($slug, $idCommentaire, CommentaireRepository $repo, ObjectManager $manager)
    {
        $commentaire = $repo->find($idCommentaire);
        $commentaire->setSignale(true);

        $manager->persist($commentaire);
        $manager->flush();

        $this->addFlash("success", "Commentaire signalé");

        return $this->redirectToRoute('figure_affichage', ["slug" => $slug]);
    }

    /**
     * @Route("/valider-commentaire/{idCommentaire}", name="valider_commentaire")
     */
    public function validerCommentaire($idCommentaire, CommentaireRepository $repo, ObjectManager $manager)
    {
        $commentaire = $repo->find($idCommentaire);
        $commentaire->setSignale(false);

        $manager->persist($commentaire);
        $manager->flush();

        $this->addFlash("success", "Signalisation commentaire retirée");

        return $this->redirectToRoute('consulter_signales');
    }

    /**
     * Supprime le commentaire sélectionné par le modérateur directement en dessous de la figure correspondante
     * 
     * @Route("/supprimer-commentaire/{slug}/{idCommentaire}", name="supprimer_commentaire")
     * @IsGranted("ROLE_MODO")
     */
    public function supprimerCommentaire($slug, $idCommentaire, CommentaireRepository $repo, ObjectManager $manager)
    {
        $commentaire = $repo->find($idCommentaire);

        $manager->remove($commentaire);
        $manager->flush();

        return $this->redirectToRoute('figure_affichage', ["slug" => $slug]);
    }

    /**
     * Supprime le commentaire sélectionné par le modérateur depuis la liste des commentaires signalés
     * 
     * @Route("/supprimer-commentaire/{idCommentaire}", name="supprimer_commentaire_via_liste")
     * @IsGranted("ROLE_MODO")
     */
    public function supprimerCommentaireViaListe($idCommentaire, CommentaireRepository $repo, ObjectManager $manager)
    {
        $commentaire = $repo->find($idCommentaire);

        $manager->remove($commentaire);
        $manager->flush();

        $this->addFlash("success", "commentaire supprimé");

        return $this->redirectToRoute('consulter_signales');
    }

    /**
     * @Route("/consulter-signales", name="consulter_signales")
     * @IsGranted("ROLE_MODO")
     */
    public function consulterCommentairesSignales(CommentaireRepository $repo)
    {
        $commentaires = $repo->findBySignale(true);

        return $this->render('gestion_commentaires/commentairesSignales.html.twig', [
            "commentaires" => $commentaires
        ]);
    }
}
