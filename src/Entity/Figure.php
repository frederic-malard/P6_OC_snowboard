<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FigureRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("nom")
 */
class Figure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * note : nullable car peut supprimer utilisateur sans supprimer figure
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="figures")
     */
    private $editeur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="figure", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="figures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Illustration", mappedBy="figure")
     */
    private $illustrations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="figure")
     */
    private $videos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Difficulte", mappedBy="figure")
     */
    private $difficultes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Figure", inversedBy="suitesPossibles")
     */
    private $prerequis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Figure", mappedBy="prerequis")
     */
    private $suitesPossibles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Utilisateur", mappedBy="favoris")
     */
    private $interesses;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prepare()
    {
        if (empty($this->slug))
            $this->slug = (new Slugify())->slugify($this->nom);
        if (empty($this->dateCreation))
            $this->dateCreation = new \DateTime();
    }

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->illustrations = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->difficultes = new ArrayCollection();
        $this->prerequis = new ArrayCollection();
        $this->suitesPossibles = new ArrayCollection();
        $this->interesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEditeur(): ?Utilisateur
    {
        return $this->editeur;
    }

    public function setEditeur(?Utilisateur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setFigure($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFigure() === $this) {
                $commentaire->setFigure(null);
            }
        }

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Illustration[]
     */
    public function getIllustrations(): Collection
    {
        return $this->illustrations;
    }

    public function addIllustration(Illustration $illustration): self
    {
        if (!$this->illustrations->contains($illustration)) {
            $this->illustrations[] = $illustration;
            $illustration->setFigure($this);
        }

        return $this;
    }

    public function removeIllustration(Illustration $illustration): self
    {
        if ($this->illustrations->contains($illustration)) {
            $this->illustrations->removeElement($illustration);
            // set the owning side to null (unless already changed)
            if ($illustration->getFigure() === $this) {
                $illustration->setFigure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setFigure($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getFigure() === $this) {
                $video->setFigure(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function getDateCreationString()
    {
        return $this->dateCreation->format('d/m/Y H:i:s');
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModificationString()
    {
        return $this->dateModification->format('d/m/Y H:i:s');
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeInterface $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * @return Collection|Difficulte[]
     */
    public function getDifficultes(): Collection
    {
        return $this->difficultes;
    }

    public function addDifficulte(Difficulte $difficulte): self
    {
        if (!$this->difficultes->contains($difficulte)) {
            $this->difficultes[] = $difficulte;
            $difficulte->setFigure($this);
        }

        return $this;
    }

    public function removeDifficulte(Difficulte $difficulte): self
    {
        if ($this->difficultes->contains($difficulte)) {
            $this->difficultes->removeElement($difficulte);
            // set the owning side to null (unless already changed)
            if ($difficulte->getFigure() === $this) {
                $difficulte->setFigure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPrerequis(): Collection
    {
        return $this->prerequis;
    }

    /**
     * regarde tous les prerequis indirects (prerequis des prerequis) jusqu'à un certain niveau de profondeur ($profondeurMaxRecherche) pour éviter de trop ralentir le site. Sert à éviter d'ajouter en prérequis une figure qui est déjà en prérequis d'une autre figure (ex : si l'utilisateur dit que pour apprendre le salto vrillé il faut connaitre le salto, la vrille et le saut, et que le saut est déjà en prérequis du salto, le saut ne sera pas ajouté aux prérequis du salto vrillé. Aide a avoir une organisation plus claire.)
     * 
     * @return Collection|self[]
     */
    public function getPrerequisIndirects($profondeurMaxRecherche = 8): Collection
    {
        if ($this->prerequis != null && $this->prerequis->isEmpty())
        {
            $prerequisIndirects = $this->prerequis; // les prérequis "indirects" portent mal leurs noms (ils contiennent les prérequis directs) ce sont tous les prérequis de la figure, directs ou non
    
            $longueur = count($prerequisIndirects);
            $premierAVerifier = 0; // indice du premier prérequis à scanner pour ajouter ses propres prérequis à la liste
            $trouveNouveauxAuTourPrecedent = true; // si on vérifie tous les prérequis du tableau sans en trouver de nouveaux, ça ne sert à rien de continuer à chercher les prérequis indirects
            $toursRestants = $profondeurMaxRecherche; // pour éviter que le temps de calcul soit trop long
    
            while ($toursRestants > 0 && $trouveNouveauxAuTourPrecedent)
            { 
                $longueurDebutTour = $longueur; // pour voir si on trouve de nouveaux éléments, et pour savoir où commencer à scanner la prochaine fois (les éléments nouveaux à la fin du tour sont ceux entre $longueurDebutTour et $longueur, qui devrait elle même grandir au fil du tour)
                for ($i=$premierAVerifier; $i < $longueurDebutTour; $i++) // les nouveaux éléments du tour précédent (ou du début si premier tour)
                { 
                    $prerequisAScanner = $prerequisIndirects[$i]; // prérequis dont on va chercher les prérequis à ce tour ci
                    $prerequisDuPrerequis = $prerequisAScanner->getPrerequis();
                    foreach ($prerequisDuPrerequis as $prerequisNivInf)
                    {
                        // le if évite les boucles et les répétitions
                        if ($prerequisNivInf != $this && ! in_array($prerequisNivInf, $prerequisIndirects))
                        {
                            $prerequisIndirects[] = $prerequisNivInf; // on ajoute le prérequis à la liste des prérequis indirects s'il ne s'y trouve pas déjà
                            $longueur++;
                        }
                    }
                }
                
                $trouveNouveauxAuTourPrecedent = ($longueur != $longueurDebutTour); // de nouveaux éléments ont été trouvés si la taille du tableau a augmentée
                $premierAVerifier = $longueurDebutTour; // au tour précédent, on scannera les prérequis qui viennent d'être ajoutés à ce tour
                $toursRestants--;
            }

            return $prerequisIndirects;
        }
        else
        {
            return new ArrayCollection();
        }
    }
    
    public function addPrerequi(self $prerequi): self
    {
        if ($this->prerequis != null)
        {
            foreach ($this->prerequis as $prerequisDejaPresents)
            {
                if ($prerequi != $this && $prerequisDejaPresents->getSuitesPossiblesIndirectes()->contains($prerequi))
                {
                    $this->removePrerequi($prerequisDejaPresents);
                }
            }
        }
        if ($prerequi != $this && ($this->getPrerequisIndirects() == null || !$this->getPrerequisIndirects()->contains($prerequi)))
        {
            $this->prerequis[] = $prerequi;
        }
        
        return $this;
    }
    
    public function removePrerequi(self $prerequi): self
    {
        if ($this->prerequis->contains($prerequi)) {
            $this->prerequis->removeElement($prerequi);
        }
        
        return $this;
    }

    public function removeAllPrerequis()
    {
        $this->prerequis = new ArrayCollection();;
    }
    
    /**
     * @return Collection|self[]
     */
    public function getSuitesPossibles(): Collection
    {
        return $this->suitesPossibles;
    }
    
    /**
     * analogue à prerequisIndirects mais  pour les suites possibles (les figures qui seront accessibles grâce à l'apprentissage de la figure $this)
     * 
     * @return Collection|self[]
     */
    public function getSuitesPossiblesIndirectes($profondeurMaxRecherche = 5): Collection
    {
        $suitesPossiblesIndirects = $this->suitesPossibles; // note : rempli automatiquement ? Vérifier

        $longueur = count($suitesPossiblesIndirects);
        $premierAVerifier = 0;
        $trouveNouveauxAuTourPrecedent = true;
        $toursRestants = $profondeurMaxRecherche;

        while ($toursRestants > 0 && $trouveNouveauxAuTourPrecedent)
        { 
            $longueurDebutTour = $longueur;
            for ($i=$premierAVerifier; $i < $longueurDebutTour; $i++)
            { 
                $suitePossiblesAScanner = $suitesPossiblesIndirects[$i];
                $suitesPossiblesDeLaSuitePossible = $suitePossiblesAScanner->getSuitesPossibles();
                foreach ($suitesPossiblesDeLaSuitePossible as $suitePossiblesNivInf)
                {
                    if ($suitePossiblesNivInf != $this && ! $suitesPossiblesIndirects->contains($suitePossiblesNivInf))
                    {
                        $suitesPossiblesIndirects[] = $suitePossiblesNivInf;
                        $longueur++;
                    }
                }
            }
            
            $trouveNouveauxAuTourPrecedent = ($longueur != $longueurDebutTour);
            $premierAVerifier = $longueurDebutTour;
            $toursRestants--;
        }

        return $suitesPossiblesIndirects;
    }

    public function addSuitesPossible(self $suitesPossible): self
    {
        if (!$this->suitesPossibles->contains($suitesPossible)) {
            $this->suitesPossibles[] = $suitesPossible;
            $suitesPossible->addPrerequi($this);
        }

        return $this;
    }

    public function removeSuitesPossible(self $suitesPossible): self
    {
        if ($this->suitesPossibles->contains($suitesPossible)) {
            $this->suitesPossibles->removeElement($suitesPossible);
            $suitesPossible->removePrerequi($this);
        }

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getInteresses(): Collection
    {
        return $this->interesses;
    }

    public function addInteress(Utilisateur $interess): self
    {
        if (!$this->interesses->contains($interess)) {
            $this->interesses[] = $interess;
            $interess->addFavori($this);
        }

        return $this;
    }

    public function removeInteress(Utilisateur $interess): self
    {
        if ($this->interesses->contains($interess)) {
            $this->interesses->removeElement($interess);
            $interess->removeFavori($this);
        }

        return $this;
    }
}
