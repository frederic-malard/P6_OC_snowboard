<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="commentaires")
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figure;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $signale;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prepare()
    {
        if (empty($this->dateCreation))
            $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function getDateCreationString()
    {
        return $this->dateCreation->format("d/m/Y à H:i:s");
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    public function setAuteur(?Utilisateur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getFigure(): ?Figure
    {
        return $this->figure;
    }

    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;

        return $this;
    }

    public function getSignale(): ?bool
    {
        return $this->signale;
    }

    public function setSignale(?bool $signale): self
    {
        $this->signale = $signale;

        return $this;
    }
}
