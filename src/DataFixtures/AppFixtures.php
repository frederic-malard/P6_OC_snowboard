<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Media;
use App\Entity\Figure;
use App\Entity\Groupe;
use Cocur\Slugify\Slugify;
use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use Faker\Provider\Youtube;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        $moderateurExiste = false;
        $adminExiste = false;

        $utilisateurs = array();

        for ($i=0 ; $i<8 ; $i++){
            $utilisateur = new Utilisateur();

            $utilisateur->setLogin($faker->word . mt_rand(1000, 9999))
                        ->setMotDePasse(str_shuffle("azertyuiopqsdFGHJKLMWXCVBN1234567890"))
                        ->setMail($faker->email);
            
            if (! $moderateurExiste)
            {
                $utilisateur->setRole("moderateur");
                $moderateurExiste = true;
            }
            elseif (! $adminExiste)
            {
                $utilisateur->setRole("administrateur");
                $adminExiste = true;
            }
            else
                $utilisateur->setRole("utilisateur");

            $manager->persist($utilisateur);
            array_push($utilisateurs, $utilisateur);
        }

        $groupes = array();

        for ($i=0 ; $i<4 ; $i++)
        {
            $groupe = new Groupe();

            $nom = $faker->word;

            $groupe->setNom($nom)
                   ->setSlug((new Slugify())->slugify($nom));
            
            $manager->persist($groupe);
            array_push($groupes, $groupe);
        }

        $figures = array();

        for ($i=0 ; $i<12 ; $i++)
        {
            $figure = new Figure();

            $nom = $faker->sentence(3);

            $figure->setNom($nom)
                   ->setDescription(implode(" ", $faker->sentences()))
                   ->setEditeur($utilisateurs[array_rand($utilisateurs)])
                   ->setSlug((new Slugify())->slugify($nom))
                   ->setGroupe($groupes[array_rand($groupes)]);
            
            $fakerYoutube = Factory::create();
            $fakerYoutube->addProvider(new Youtube($faker));
            
            for ($i=0 ; $i<mt_rand(6, 20) ; $i++)
            {
                $media = new Media();

                $media->setUrl($fakerYoutube->youtubeEmbedUri())
                      ->setAlt($faker->sentence())
                      ->setVideo(mt_rand(0, 1))
                      ->setFigure($figure);
                
                $manager->persist($media);
            }
            
            for ($i=0 ; $i<mt_rand(0, 30) ; $i++)
            {
                $commentaire = new Commentaire();

                $commentaire->setDateCreation(new \DateTime())
                            ->setContenu(implode(" ", $faker->sentences()))
                            ->setAuteur($utilisateurs[array_rand($utilisateurs)])
                            ->setFigure($figure);
                
                $manager->persist($commentaire);
            }
            
            $manager->persist($figure);
            array_push($figures, $figure);
        }

        $manager->flush();
    }
}
