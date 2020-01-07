<?php

namespace App\Service;

use App\Entity\Illustration;
use Doctrine\Common\Persistence\ObjectManager;

class Pagination
{
    // private $manager;
    // private $figure;
    // private $illustrations;

    public function __construct(ObjectManager $manager)
    {
        // $this->manager = $manager;
    }

    // public function traiterDonnees($figure, $illustrations)
    // {
    //     $this->figure = $figure;
    //     $this->illustrations = $illustrations;

    //     $this->traiterIllustrations();
    //     $this->traiterPrerequis();
    //     $this->traiterVideos();

    //     $this->manager->persist($this->figure);
    //     $this->manager->flush();
    // }
}