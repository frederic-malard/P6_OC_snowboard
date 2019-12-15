<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields={"login"}, message="Ce login est déjà pris.")
 * @ORM\HasLifecycleCallbacks
 */
class Utilisateur implements UserInterface
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
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motDePasse;

    /**
     * @Assert\EqualTo(propertyPath="motDePasse", message="Le mot de passe doit être identique à sa confirmation")
     */
    public $confirmationMdp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Figure", mappedBy="editeur")
     */
    private $figures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="auteur")
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Difficulte", mappedBy="notant")
     */
    private $difficultes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aVerifier;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Figure", inversedBy="interesses")
     */
    private $favoris;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prepare()
    {
        if (empty($this->slug))
            $this->slug = (new Slugify)->slugify($this->login);
        if (empty($this->role))
            $this->role = "utilisateur";
    }

    public function __construct()
    {
        $this->figures = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->difficultes = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    public function addFigure(Figure $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setEditeur($this);
        }

        return $this;
    }

    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->contains($figure)) {
            $this->figures->removeElement($figure);
            // set the owning side to null (unless already changed)
            if ($figure->getEditeur() === $this) {
                $figure->setEditeur(null);
            }
        }

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
            $commentaire->setAuteur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getAuteur() === $this) {
                $commentaire->setAuteur(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getRoles()
    {
        $roles = array();
        
        if ($this->role == "administrateur")
            $roles = ['ROLE_USER', 'ROLE_MODO', 'ROLE_ADMIN'];
        elseif ($this->role == "moderateur")
            $roles = ['ROLE_USER', 'ROLE_MODO'];
        else
            $roles = ['ROLE_USER'];
        
        return $roles;
    }

    public function getPassword()
    {
        return $this->motDePasse;
    }

    public function getSalt(){}

    public function getUsername()
    {
        return $this->login;
    }

    public function eraseCredentials(){}

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
            $difficulte->setNotant($this);
        }

        return $this;
    }

    public function removeDifficulte(Difficulte $difficulte): self
    {
        if ($this->difficultes->contains($difficulte)) {
            $this->difficultes->removeElement($difficulte);
            // set the owning side to null (unless already changed)
            if ($difficulte->getNotant() === $this) {
                $difficulte->setNotant(null);
            }
        }

        return $this;
    }

    public function getAVerifier(): ?string
    {
        return $this->aVerifier;
    }

    public function setAVerifier(?string $aVerifier): self
    {
        $this->aVerifier = $aVerifier;

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Figure $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
        }

        return $this;
    }

    public function removeFavori(Figure $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
        }

        return $this;
    }
}
