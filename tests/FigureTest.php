<?php

namespace Tests\Entity;

use App\Entity\Figure;
use PHPUnit\Framework\TestCase;
use App\Repository\FigureRepository;
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

        dump('$prerequisIndirectsFigure3 : ');
        dump($prerequisIndirectsFigure3);
        dump('$figure2->getPrerequis() : ');
        dump($figure2->getPrerequis());
        dump('$figure3->getPrerequis() : ');
        dump($figure3->getPrerequis());

        /*$prerequisArray = [];

        foreach ($prerequisIndirectsFigure3 as $pif3) {
            $prerequisArray[] = $pif3;
        }*/
        
        $this->assertContains($figure1, $prerequisIndirectsFigure3);
    }
    /*public function prerequisDoublonEfface() // Possible à tester ? Accès traiterPrerequis
    {
        $this->assertSame(1, 1);
    }
    public function suitePossibleIndirecteTrouvee()
    {
        $this->assertSame(1, 1);
    }
    public function suitePossibleDoublonEfface()
    {
        $this->assertSame(1, 1);
    }
    public function difficulteMoyenne()
    {
        $this->assertSame(1, 1);
    }
    public function difficulteCouleurTitre()
    {
        $this->assertSame(1, 1);
    }
    public function nbAffichagesDifficulte()
    {
        $this->assertSame(1, 1);
    }*/
}