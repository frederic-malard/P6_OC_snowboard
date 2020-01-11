<?php

namespace Tests\Entity;

use App\Entity\Figure;
use App\Entity\Difficulte;
use App\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;
use App\Repository\FigureRepository;
use App\Service\TraitementAjoutFigure;
use App\Repository\UtilisateurRepository;

class FigureTest extends TestCase
{


    
    // tester prérequis indirects, suitesPossiblesIndirectes, et difficultés

    public function testPrerequisIndirectTrouve()
    {
        $figure1 = new Figure();
        $figure2 = new Figure();
        $figure3 = new Figure();

        $figure1->setNom("abc");
        $figure2->setNom("def");
        $figure3->setNom("ghi");

        $figure2->addPrerequi($figure1);
        $figure3->addPrerequi($figure2);

        $prerequisIndirectsFigure3 = $figure3->getPrerequisIndirects();
        
        $this->assertContains($figure1, $prerequisIndirectsFigure3);
    }

    public function testPrerequisDoublonEfface() // Possible à tester ? Accès traiterPrerequis
    {
        $figure1 = new Figure();

        $figure1->setNom("abc");
        
        $figure1->addPrerequi($figure1); // tentative de création de boucle*/
        
        // vérifie que toutes les mauvaises tentatives aient été déjouées
        $this->assertNotContains($figure1, $figure1->getPrerequis());
    }

    public function testSuitePossibleIndirecteTrouvee()
    {
        $figure1 = new Figure();
        $figure2 = new Figure();
        $figure3 = new Figure();

        $figure1->setNom("abc");
        $figure2->setNom("def");
        $figure3->setNom("ghi");

        $figure1->addSuitesPossible($figure2);
        $figure2->addSuitesPossible($figure3);

        $suitesPossiblesIndirectesFigure1 = $figure1->getSuitesPossiblesIndirectes();
        
        $this->assertContains($figure3, $suitesPossiblesIndirectesFigure1);
    }

    public function testDifficulteMoyenne()
    {
        $figure = new Figure();

        $utilisateur1 = new Utilisateur();
        $utilisateur2 = new Utilisateur();
        $utilisateur3 = new Utilisateur();

        $utilisateur1->setLogin("login1");
        $utilisateur2->setLogin("login2");
        $utilisateur3->setLogin("login3");

        $figure->setEditeur($utilisateur2);
        
        $difficulte1 = new Difficulte();
        $difficulte1->setNote(3);
        $difficulte1->setNotant($utilisateur1);
        $difficulte1->setFigure($figure);
        
        $difficulte2 = new Difficulte();
        $difficulte2->setNote(4);
        $difficulte2->setNotant($utilisateur2);
        $difficulte2->setFigure($figure);
        
        $difficulte3 = new Difficulte();
        $difficulte3->setNote(9);
        $difficulte3->setNotant($utilisateur3);
        $difficulte3->setFigure($figure);

        $figure->addDifficulte($difficulte1);
        $figure->addDifficulte($difficulte2);
        $figure->addDifficulte($difficulte3);

        $difficulteMoyenne = $figure->getDifficulteMoyenneSansEditeur();

        $moyenneSupposee = ($difficulte1->getNote() + $difficulte3->getNote()) / 2; // note : la difficulte2 ne doit pas être comprise dans la moyenne, car il s'agit de la moyenne en excluant l'éditeur de la figure, qui a son propre affichage pour sa note. Et la difficulté 2 donne la note de l'utilisateur 2 qui est l'éditeur de la figure.

        $this->assertEquals($difficulteMoyenne, $moyenneSupposee);
    }

    public function testDifficulteTitreBlancheSansNotes()
    {
        $figure = new Figure();

        $couleur = $figure->couleurTitreDifficulte();

        $this->assertEquals($couleur, "white");
    }
    
    public function testUnAffichageDifficulteSiAucuneNoteEtUtilisateurConnecte()
    {
        $figure = new Figure();

        $utilisateur = new Utilisateur(); // supposé utilisateur connecté

        $nombre = $figure->nbAffichagesDifficulte($utilisateur);

        $this->assertEquals($nombre, 1);
    }
}