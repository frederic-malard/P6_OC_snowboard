<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DifficulteRepository")
 */
class Difficulte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThanOrEqual(10)
     * @Assert\GreaterThan(0)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="difficultes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="difficultes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getNotant(): ?Utilisateur
    {
        return $this->notant;
    }

    public function setNotant(?Utilisateur $notant): self
    {
        $this->notant = $notant;

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
}
