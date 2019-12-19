<?php

namespace App\Service;

use App\Entity\Illustration;
use Doctrine\Common\Persistence\ObjectManager;

class TraitementDonneesFigure
{
    private $manager;
    private $figure;
    private $illustrations;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function traiterIllustrations()
    {
        if($this->illustrations)
        {
            foreach ($this->illustrations as $illustrationFichier) {
                $dossier = "illustrations";
                $extension = $illustrationFichier->guessExtension();
                if(!$extension)
                    $extension = "bin";
                $nomIllustration = rand(1, 999999999);
    
                $illustrationFichier->move($dossier, $nomIllustration . "." . $extension);

                $illustration = new Illustration();

                $illustration->setUrl("/" . $dossier . "/" . $nomIllustration . "." . $extension)
                             ->setAlt("une illustration de la figure " . $this->figure->getNom())
                             ->setFigure($this->figure);

                $this->manager->persist($illustration);
    
                $this->figure->addIllustration($illustration);
            }
        }
    }

    public function traiterPrerequis()
    {
        // efface tous les prérequis pour les réinsérer avec addPrerequis pour faire toutes les vérifications incluses dans la méthode avec ajout
        $prerequis = $this->figure->getPrerequis();

        $this->figure->removeAllPrerequis();

        foreach($prerequis as $unPrerequis)
        {
            $this->figure->addPrerequi($unPrerequis);
        }
    }

    public function traiterVideos()
    {
        $videos = $this->figure->getVideos();

        foreach ($videos as $video) {
            $video->setFigure($this->figure);

            $this->manager->persist($video);

            //$figure->addVideo($video);
        }
    }

    public function traiterDonnees($figure, $illustrations)
    {
        $this->figure = $figure;
        $this->illustrations = $illustrations;

        $this->traiterIllustrations();
        $this->traiterPrerequis();
        $this->traiterVideos();

        $this->manager->persist($this->figure);
        $this->manager->flush();
    }
}