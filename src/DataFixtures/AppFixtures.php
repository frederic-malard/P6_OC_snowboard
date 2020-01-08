<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Video;
use App\Entity\Figure;
use App\Entity\Groupe;
use App\Entity\Difficulte;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use Faker\Provider\Youtube;
use App\Entity\Illustration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    public function groupes()
    {
        $groupes = [
            "ride" => (new Groupe())->setNom("ride"),
            "grab" => (new Groupe())->setNom("grab"),
            "rotation" => (new Groupe())->setNom("rotation"),
            "flip" => (new Groupe())->setNom("flip"),
            "rotation désaxée" => (new Groupe())->setNom("rotation désaxée"),
            "slide" => (new Groupe())->setNom("slide"),
            "one foot trick" => (new Groupe())->setNom("one foot trick"),
            "old school" => (new Groupe())->setNom("old school")
        ];

        return $groupes;
    }

    public function utilisateurs()
    {
        $faker = Factory::create('FR-fr');

        $moderateurExiste = false;
        $adminExiste = false;

        $genres = ['homme', 'femme'];

        $utilisateurs = array();

        for ($i=0 ; $i<8 ; $i++){
            $utilisateur = new Utilisateur();

            /*$urlAvatar = "https://randomuser.me/api/portraits/";
            $genre = $faker->randomElement($genres);
            $idAvatar = $faker->numberBetween(1, 99);*/

            
            $utilisateur->setMail($faker->email);
            
            if ($i < 7)
            {
                $avatar = "/avatars/" . ($i+1) . ".png";
                $utilisateur->setAvatar($avatar);
            }
            
            if (! $moderateurExiste)
            {
                $utilisateur->setRole("moderateur")
                            ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpModo1048"))
                            ->setLogin("modo");
                $moderateurExiste = true;
            }
            elseif (! $adminExiste)
            {
                $utilisateur->setRole("administrateur")
                            ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpAdmin8590"))
                            ->setLogin("admin");
                $adminExiste = true;
            }
            else
            {
                $utilisateur->setRole("utilisateur")
                    ->setLogin($faker->word . mt_rand(1000, 9999))
                    ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpBidon0392"))
                ;
            }

            array_push($utilisateurs, $utilisateur);
        }
        
        return $utilisateurs;
    }
    
    public function illustrations($nomsImages)
    {
        $dossierIllustrations = "/illustrations/";

        $illustrations = new ArrayCollection();

        foreach ($nomsImages as $nomImage) {
            $illustration = new Illustration();

            $illustration
                ->setUrl($dossierIllustrations . $nomImage)
                ->setAlt("photo " . $nomImage)
            ;

            $illustrations->add($illustration);
        }

        return $illustrations;
    }

    public function videos($embeds/*, $isYoutube = true*/)
    {
        $youtubeEmbed = "https://www.youtube.com/embed/";
        //$dailymotionEmbed = "https://www.dailymotion.com/video/";

        $videos = new ArrayCollection();

        foreach ($embeds as $embed) {
            $video = new Video();

            $video
                ->setUrl($youtubeEmbed . $embed)
                ->setAlt("video")
            ;

            $videos->add($video);
        }

        return $videos;
    }

    public function figure($nom, $description, $utilisateurs, $groupe)
    {
        $editeur = $utilisateurs[mt_rand(0, count($utilisateurs) - 1)];

        $interesses = array();

        foreach ($utilisateurs as $utilisateur) {
            if (mt_rand(0, 6) == 3)
                $interesses[] = $utilisateur;
        }

        $figure = new Figure();

        $figure
            ->setNom($nom)
            ->setDescription($description)
            ->setEditeur($editeur)
            ->setGroupe($groupe)
            ->setInteresses($interesses)
        ;

        // pour tester le tri par date
        $timestampRandom = time() - (mt_rand(0, 365*86400)); // un timestamp au hasard dans l'année passée
        $dateRandom = new \DateTime();
        $dateRandom->setTimestamp($timestampRandom);

        $figure->setDateCreation($dateRandom);

        return $figure;
    }

    public function liensFigureIllusVideos(&$figure, &$illustrations, &$videos)
    {
        $figure
            ->setIllustrations($illustrations)
            ->setVideos($videos)
        ;

        foreach ($illustrations as $illustration) {
            $illustration->setFigure($figure);
            $this->manager->persist($illustration);
        }

        foreach ($videos as $video) {
            $video->setFigure($figure);
            $this->manager->persist($video);
        }
    }

    public function figures($utilisateurs, $groupes)
    {
        $figures = array();

        /******************
         * 
         * RIDES
         * 
         ******************/
                
        // REGULAR
        
        $description = "Détermine la position sur la planche. Un rider regular aura le pied gauche devant.";
        
        $nomsIllustrations = [
            "regular-1.jpg",
            "regular-2.jpg",
            "regular-goofy-1.jpg",
            "regular-goofy-2.jpg",
            "regular-goofy-3.jpg",
            "regular-goofy-4.jpg"
        ];
        
        $embeds = ["u20epr7tSEU"];

        $regular = $this->figure(
            "regular",
            $description,
            $utilisateurs,
            $groupes["ride"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($regular, $illustrations, $videos);
        
        $figures["regular"] = $regular;
        
        // GOOFY
        
        $description = "Détermine la position sur la planche. Un rider goofy aura le pied droit devant.";
        
        $nomsIllustrations = [
            "goofy-1.jpg",
            "regular-goofy-1.jpg",
            "regular-goofy-2.jpg",
            "regular-goofy-3.jpg",
            "regular-goofy-4.jpg"
        ];
        
        $embeds = ["GcacU4p2W-o"];

        $goofy = $this->figure(
            "goofy",
            $description,
            $utilisateurs,
            $groupes["ride"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($goofy, $illustrations, $videos);
        
        $figures["goofy"] = $goofy;

        /*********************
         * 
         * GRABS
         * 
         *********************/

        // MUTE
        
        $description = "Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.";
        
        $nomsIllustrations = [
            "mute-grab-1.png",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["51sQRIK-TEI", "Opg5g4zsiGY"];

        $mute = $this->figure(
            "mute",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($mute, $illustrations, $videos);

        $mute->addPrerequi($regular);
        $mute->addPrerequi($goofy);
        
        $figures["mute"] = $mute;

        // SAD
        
        $description = "Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant. Aussi appelé \"melancholie\" ou \"style week\"";
        
        $nomsIllustrations = [
            "sad-1.jpg"
        ];
        
        $embeds = ["KEdFwJ4SWq4", "CA5bURVJ5zk"];

        $sad = $this->figure(
            "sad",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($sad, $illustrations, $videos);

        $sad->addPrerequi($regular);
        $sad->addPrerequi($goofy);
        
        $figures["sad"] = $sad;

        // INDY
        
        $description = "Saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.";
        
        $nomsIllustrations = [
            "indy-1.jpg",
            "indy-2.jpg",
            "indy-3.jpg",
            "indy-4.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["iKkhKekZNQ8", "6QsLhWzXGu0", "6yA3XqjTh_w"];

        $indy = $this->figure(
            "indy",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($indy, $illustrations, $videos);

        $indy->addPrerequi($regular);
        $indy->addPrerequi($goofy);
        
        $figures["indy"] = $indy;

        // STALEFISH
        
        $description = "Saisie de la carre backside de la planche entre les deux pieds avec la main arrière.";
        
        $nomsIllustrations = [
            "stalefish-1.jpg",
            "stalefish-2.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["f9FjhCt_w2U"];

        $stalefish = $this->figure(
            "stalefish",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($stalefish, $illustrations, $videos);

        $stalefish->addPrerequi($regular);
        $stalefish->addPrerequi($goofy);
        
        $figures["stalefish"] = $stalefish;

        // TAIL
        
        $description = "Saisie de la partie arrière de la planche, avec la main arrière.";
        
        $nomsIllustrations = [
            "tail-1.jpg",
            "tail-2.jpg",
            "tail-3.jpg",
            "tail-4.jpg",
            "tail-5.jpg",
            "tail-6.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["id8VKl9RVQw", "_Qq-YoXwNQY"];

        $tail = $this->figure(
            "tail",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($tail, $illustrations, $videos);

        $tail->addPrerequi($regular);
        $tail->addPrerequi($goofy);
        
        $figures["tail"] = $tail;

        // NOSE
        
        $description = "Saisie de la partie avant de la planche, avec la main avant.";
        
        $nomsIllustrations = [
            "nose-1.jpg",
            "nose-2.jpg",
            "nose-3.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["gZFWW4Vus-Q", "M-W7Pmo-YMY"];

        $nose = $this->figure(
            "nose",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($nose, $illustrations, $videos);

        $nose->addPrerequi($regular);
        $nose->addPrerequi($goofy);
        
        $figures["nose"] = $nose;

        // JAPAN
        
        $description = "Saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside. Aussi appelé \"japan air\".";
        
        $nomsIllustrations = [
            "japan-1.jpg",
            "japan-2.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["CzDjM7h_Fwo", "jH76540wSqU"];

        $japan = $this->figure(
            "japan",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($japan, $illustrations, $videos);

        $japan->addPrerequi($regular);
        $japan->addPrerequi($goofy);
        
        $figures["japan"] = $japan;

        // SEATBELT
        
        $description = "Saisie du carre frontside à l'arrière avec la main avant.";
        
        $nomsIllustrations = [
            "seatbelt-1.jpg",
            "seatbelt-2.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = ["4vGEOYNGi_c", "eTx2uVcbLzM"];

        $seatbelt = $this->figure(
            "seatbelt",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($seatbelt, $illustrations, $videos);

        $seatbelt->addPrerequi($regular);
        $seatbelt->addPrerequi($goofy);
        
        $figures["seatbelt"] = $seatbelt;

        // TRUCK DRIVER
        
        $description = "Saisie du carre frontside à l'arrière avec la main avant.";
        
        $nomsIllustrations = [
            "truck-driver-1.jpg",
            "grabs-1.jpg",
            "grabs-2.png",
            "grabs-3.jpg"
        ];
        
        $embeds = [];

        $truckdriver = $this->figure(
            "truckdriver",
            $description,
            $utilisateurs,
            $groupes["grab"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($truckdriver, $illustrations, $videos);

        $truckdriver->addPrerequi($regular);
        $truckdriver->addPrerequi($goofy);
        
        $figures["truckdriver"] = $truckdriver;

        /**************************
         * 
         * ROTATIONS
         * 
         **************************/

        // 180

        $description = "Un 180 désigne un demi-tour, soit 180 degrés d'angle.";
        
        $nomsIllustrations = [];
        
        $embeds = ["JMS2PGAFMcE", "GnYAlEt-s00", "ATMiAVTLsuc"];

        $r180 = $this->figure(
            "180",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r180, $illustrations, $videos);

        $r180->addPrerequi($regular);
        $r180->addPrerequi($goofy);
        
        $figures["180"] = $r180;

        // 360

        $description = "360, trois six pour un tour complet.";
        
        $nomsIllustrations = [];
        
        $embeds = ["GS9MMT_bNn8", "hUddT6FGCws", "6gFsbU3GWF0"];

        $r360 = $this->figure(
            "360",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r360, $illustrations, $videos);

        $r360->addPrerequi($regular);
        $r360->addPrerequi($goofy);
        
        $figures["360"] = $r360;

        // 540

        $description = "540, cinq quatre pour un tour et demi.";
        
        $nomsIllustrations = [];
        
        $embeds = ["_hJX9HrdkeA", "cdekJgZs9qY", "K0dx4qT4wrQ"];

        $r540 = $this->figure(
            "540",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r540, $illustrations, $videos);

        $r540->addPrerequi($regular);
        $r540->addPrerequi($goofy);
        
        $figures["540"] = $r540;

        // 720

        $description = "720, sept deux pour deux tours complets.";
        
        $nomsIllustrations = [];
        
        $embeds = ["4JfBfQpG77o", "XkkUSEz3I00", "H0-apzROnqE"];

        $r720 = $this->figure(
            "720",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r720, $illustrations, $videos);

        $r720->addPrerequi($regular);
        $r720->addPrerequi($goofy);
        
        $figures["720"] = $r720;

        // 900

        $description = "900 pour deux tours et demi.";
        
        $nomsIllustrations = [];
        
        $embeds = ["g8QUV2Vl1Zw", "G7Hgj0i95Ag", "8ifvMImDkew"];

        $r900 = $this->figure(
            "900",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r900, $illustrations, $videos);

        $r900->addPrerequi($regular);
        $r900->addPrerequi($goofy);
        
        $figures["900"] = $r900;

        // 1080

        $description = "1080 ou big foot pour trois tours.";
        
        $nomsIllustrations = [];
        
        $embeds = ["VXb3IjPh3sI", "EsP0fzKi6Ac"];

        $r1080 = $this->figure(
            "1080",
            $description,
            $utilisateurs,
            $groupes["rotation"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($r1080, $illustrations, $videos);

        $r1080->addPrerequi($regular);
        $r1080->addPrerequi($goofy);
        
        $figures["1080"] = $r1080;

        /*************************
         * 
         * FLIPS
         * 
         *************************/

        // front

        $description = "Rotations en avant.";
        
        $nomsIllustrations = [
            "front-flip-1.jpg",
            "front-flip-2.jpg",
            "front-flip-3.jpg",
            "front-flip-4.jpg"
        ];
        
        $embeds = ["xhvqu2XBvI0", "eGJ8keB1-JM", "aTTkQ45DUfk"];

        $frontflip = $this->figure(
            "frontflip",
            $description,
            $utilisateurs,
            $groupes["flip"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($frontflip, $illustrations, $videos);

        $frontflip->addPrerequi($regular);
        $frontflip->addPrerequi($goofy);
        
        $figures["frontflip"] = $frontflip;

        // back

        $description = "Rotations en arrière.";
        
        $nomsIllustrations = [
            "back-flip-1.jpg",
            "back-flip-2.jpg",
            "back-flip-3.jpg"
        ];
        
        $embeds = ["SlhGVnFPTDE", "AMsWP9WJS_0", "arzLq-47QFA"];

        $backflip = $this->figure(
            "backflip",
            $description,
            $utilisateurs,
            $groupes["flip"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($backflip, $illustrations, $videos);

        $backflip->addPrerequi($regular);
        $backflip->addPrerequi($goofy);
        
        $figures["backflip"] = $backflip;

        /**********************
         * 
         * ROTATIONS DÉSAXÉES
         * 
         **********************/

        // cork 540

        $description = "Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Le cork 540 est un 540 combiné avec un backflip.";
        
        $nomsIllustrations = [
            "cork540-1.jpg",
            "cork540-2.jpg"
        ];
        
        $embeds = ["FMHiSF0rHF8"];

        $cork540 = $this->figure(
            "cork540",
            $description,
            $utilisateurs,
            $groupes["rotation désaxée"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($cork540, $illustrations, $videos);

        $cork540->addPrerequi($backflip);
        $cork540->addPrerequi($r540);
        
        $figures["cork540"] = $cork540;

        /**********************
         * 
         * SLIDES
         * 
         **********************/

        // slide

        $description = "Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.";
        
        $nomsIllustrations = [
            "slide-1.jpg",
            "slide-2.jpg"
        ];
        
        $embeds = ["WOgw5uBSLp0", "R3OG9rNDIcs"];

        $slide = $this->figure(
            "slide",
            $description,
            $utilisateurs,
            $groupes["slide"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($slide, $illustrations, $videos);

        $slide->addPrerequi($goofy);
        $slide->addPrerequi($regular);
        
        $figures["slide"] = $slide;

        // nose slide

        $description = "Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. Un nose slide est un slide fait sur l'avant de la planche.";
        
        $nomsIllustrations = [
            "nose-slide-1.jpg"
        ];
        
        $embeds = ["oAK9mK7wWvw"];

        $noseSlide = $this->figure(
            "nose slide",
            $description,
            $utilisateurs,
            $groupes["slide"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($noseSlide, $illustrations, $videos);

        $noseSlide->addPrerequi($slide);
        
        $figures["nose slide"] = $noseSlide;

        // tail slide

        $description = "Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé. Un tail slide est un slide fait sur l'arrière de la planche.";
        
        $nomsIllustrations = [
            "tail-slide-1.jpg"
        ];
        
        $embeds = ["HRNXjMBakwM", "KqSi94FT7EE"];

        $tailSlide = $this->figure(
            "tail slide",
            $description,
            $utilisateurs,
            $groupes["slide"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($tailSlide, $illustrations, $videos);

        $tailSlide->addPrerequi($slide);
        
        $figures["tail slide"] = $tailSlide;

        /*********************
         * 
         * ONE FOOT TRICKS
         * 
         *********************/

        // one foot tricks

        $description = "Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.";
        
        $nomsIllustrations = [
            "one-foot-trick-1.jpg",
            "one-foot-trick-2.jpg",
            "one-foot-trick-3.jpg"
        ];
        
        $embeds = ["4IVdWdvsrVA", "d7dpo_G9npo"];

        $oneFootTrick = $this->figure(
            "one foot trick",
            $description,
            $utilisateurs,
            $groupes["one foot trick"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($oneFootTrick, $illustrations, $videos);
        
        $figures["one foot trick"] = $oneFootTrick;

        /*******************
         * 
         * OLD SCHOOL
         * 
         *******************/

        // rocket air

        $description = "Attrapez l'avant de la planche et mettez la planche a la verticale.";
        
        $nomsIllustrations = [
            "rocket-air-1.jpg",
            "rocket-air-2.jpg",
            "rocket-air-3.jpg"
        ];
        
        $embeds = ["4IVdWdvsrVA", "d7dpo_G9npo"];

        $rocketAir = $this->figure(
            "rocket air",
            $description,
            $utilisateurs,
            $groupes["old school"]
        );

        $illustrations = $this->illustrations($nomsIllustrations);
        $videos = $this->videos($embeds);

        $this->liensFigureIllusVideos($rocketAir, $illustrations, $videos);

        $rocketAir->addPrerequi($regular);
        $rocketAir->addPrerequi($goofy);
        
        $figures["rocket air"] = $rocketAir;


        return $figures;
    }

    public function commentaires(&$utilisateurs, &$figures)
    {
        $faker = Factory::create('FR-fr');

        foreach ($utilisateurs as $utilisateur) {
            foreach ($figures as $figure) {
                if (mt_rand(0, 3) == 2)
                {
                    $commentaire = new Commentaire();

                    $commentaire->setDateCreation(new \DateTime())
                                ->setContenu(implode(" ", $faker->sentences()))
                                ->setAuteur($utilisateur)
                                ->setFigure($figure);

                    if (mt_rand(0, 4) == 2)
                        $commentaire->setSignale(true);
                    
                    $this->manager->persist($commentaire);
                }
            }
        }
    }

    public function difficultes(&$utilisateurs, &$figures)
    {
        $faker = Factory::create('FR-fr');

        foreach ($utilisateurs as $utilisateur) {
            foreach ($figures as $figure) {
                if (mt_rand(0, 7) == 3)
                {
                    $difficulte = new Difficulte();

                    $difficulte->setNote(mt_rand(1, 10))
                               ->setNotant($utilisateur)
                               ->setFigure($figure);
                    
                    $this->manager->persist($difficulte);
                }
            }
        }
    }

    public function load(ObjectManager $manager)
    {
        $groupes = $this->groupes();
        $utilisateurs = $this->utilisateurs();
        $figures = $this->figures($utilisateurs, $groupes);
        $commentaires = $this->commentaires($utilisateurs, $figures);
        $difficultes = $this->difficultes($utilisateurs, $figures);

        foreach ($groupes as $groupe) {
            $this->manager->persist($groupe);
        }

        foreach ($utilisateurs as $utilisateur) {
            $this->manager->persist($utilisateur);
        }

        foreach ($figures as $figure) {
            $this->manager->persist($figure);
        }

        $this->manager->flush();
    }

    public function ancienLoad(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        $moderateurExiste = false;
        $adminExiste = false;

        $genres = ['homme', 'femme'];

        $utilisateurs = array();

        for ($i=0 ; $i<8 ; $i++){
            $utilisateur = new Utilisateur();

            $urlAvatar = "https://randomuser.me/api/portraits/";
            $genre = $faker->randomElement($genres);
            $idAvatar = $faker->numberBetween(1, 99);

            $avatar = $urlAvatar . $genre . "/" . $idAvatar . ".jpg";

            $utilisateur->setLogin($faker->word . mt_rand(1000, 9999))
                        ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpBidonExemple"))
                        ->setMail($faker->email);
            
            if ($faker->numberBetween(0, 3) != 0)
                $utilisateur->setAvatar($avatar);
            
            if (! $moderateurExiste)
            {
                $utilisateur->setRole("moderateur")
                            ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpModo1048"))
                            ->setLogin("modo")
                            ->setMail("fred.mgm2@gmail.com");
                $moderateurExiste = true;
            }
            elseif (! $adminExiste)
            {
                $utilisateur->setRole("administrateur")
                            ->setMotDePasse($this->encoder->encodePassword($utilisateur, "mdpAdmin8590"))
                            ->setLogin("admin")
                            ->setMail("fred.mgm2@gmail.com");
                $adminExiste = true;
            }
            else
                $utilisateur->setRole("utilisateur");

            $manager->persist($utilisateur);
            array_push($utilisateurs, $utilisateur);
        }

        $groupes = array();

        for ($j=0 ; $j<4 ; $j++)
        {
            $groupe = new Groupe();

            $nom = $faker->word;

            $groupe->setNom($nom);
            
            $manager->persist($groupe);
            array_push($groupes, $groupe);
        }

        $figures = array();

        for ($k=0 ; $k<20 ; $k++)
        {
            $figure = new Figure();

            $nom = $faker->sentence(3);

            $figure->setNom($nom)
                   ->setDescription(implode(" ", $faker->sentences()))
                   ->setEditeur($utilisateurs[array_rand($utilisateurs)])
                   ->setGroupe($groupes[array_rand($groupes)]);
                   
            for ($l=0 ; $l<mt_rand(0, 5) ; $l++)
            {
                $illustration = new Illustration();
                
                $illustration->setUrl($faker->imageUrl(720, 480))
                             ->setAlt($faker->sentence())
                             ->setFigure($figure);
                
                $manager->persist($illustration);
            }
            
            $fakerYoutube = Factory::create();
            $fakerYoutube->addProvider(new Youtube($faker));
                    
            for ($m=0 ; $m<mt_rand(0, 5) ; $m++)
            {
                $video = new Video();

                $video->setUrl($fakerYoutube->youtubeEmbedUri())
                      ->setAlt($faker->sentence())
                      ->setFigure($figure);
                
                $manager->persist($video);
            }
            
            for ($n=0 ; $faker->numberBetween(0, 30) ; $n++)
            {
                $commentaire = new Commentaire();

                $commentaire->setDateCreation(new \DateTime())
                            ->setContenu(implode(" ", $faker->sentences()))
                            ->setAuteur($utilisateurs[array_rand($utilisateurs)])
                            ->setFigure($figure);
                
                $manager->persist($commentaire);
            }

            foreach ($utilisateurs as $utilisateur) {
                if (mt_rand(1, 3) == 2)
                {
                    $difficulte = new Difficulte();

                    $difficulte->setNote(mt_rand(1, 10))
                               ->setNotant($utilisateur)
                               ->setFigure($figure);

                    $manager->persist($difficulte);
                }
            }
            
            $manager->persist($figure);
            array_push($figures, $figure);
        }

        $manager->flush();
    }
}
