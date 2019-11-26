<?php

namespace Tests\Entity;

use App\Entity\Figure;
use PHPUnit\Framework\TestCase;
use App\Repository\FigureRepository;
use App\Repository\UtilisateurRepository;

class FigureTest extends TestCase
{
    public function testBidon()
    {
        $this->assertSame(1, 1);
    }
}