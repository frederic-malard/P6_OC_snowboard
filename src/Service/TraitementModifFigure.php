<?php

namespace App\Service;

use App\Entity\Illustration;
use App\Repository\VideoRepository;
use App\Repository\FigureRepository;
use App\Repository\IllustrationRepository;
use Doctrine\Common\Persistence\ObjectManager;

class TraitementModifFigure
{
    private $manager;
    private $figure;
    private $nouvellesIllustrations;
    private $nouvellesVideos;
    private $illustrationRepository;
    private $videoRepository;
    private $figureRepository;

    public function __construct(ObjectManager $manager, IllustrationRepository $illustrationRepository, VideoRepository $videoRepository, FigureRepository $figureRepository)
    {
        $this->manager = $manager;
        $this->illustrationRepository = $illustrationRepository;
        $this->videoRepository = $videoRepository;
        $this->figureRepository = $figureRepository;
    }

    public function traiterNouvellesIllustrations()
    {
        if($this->nouvellesIllustrations)
        {
            foreach ($this->nouvellesIllustrations as $illustrationFichier) {
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

    public function traiterNouvellesVideos()
    {
        if($this->nouvellesVideos)
        {
            foreach ($this->nouvellesVideos as $video) {
                $video->setFigure($this->figure);

                $this->manager->persist($video);
    
                $this->figure->addVideo($video);
            }
        }
    }

    public function traiterAnciennesVideos()
    {
        /*$videos = $this->figure->getVideos();

        foreach ($videos as $video) {
            $video->setFigure($this->figure);

            $this->manager->persist($video);

            //$figure->addVideo($video);
        }*/
    }

    public function traiterAnciennesIllustrations()
    {
        /*$illustrationsForm = $this->figure->getIllustrations();
        $figureBase = $this->figureRepository->find($this->figure->getId());
        $illustrationsBase = $figureBase->getIllustrations();

        dump($illustrationsForm);
        dump($illustrationsBase);
        die();

        foreach ($illustrationsBase as $illustrationBase) {
            if(! $illustrationsForm->contains($illustrationBase))
            {
                $this->manager->remove($illustrationBase);
            }
        }*/
    }

    public function traiterDonnees($figure, $nouvellesIllustrations, $nouvellesVideos)
    {
        $this->figure = $figure;
        $this->nouvellesIllustrations = $nouvellesIllustrations;
        $this->nouvellesVideos = $nouvellesVideos;

        $this->traiterAnciennesIllustrations();
        $this->traiterAnciennesVideos();
        $this->traiterNouvellesIllustrations();
        $this->traiterNouvellesVideos();
        $this->traiterPrerequis();

        /*dump($figure);
        die();*/

        $this->manager->persist($this->figure);
        $this->manager->flush();
    }
}