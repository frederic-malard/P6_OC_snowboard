<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('tetes', [$this, 'tetesDeMort']),
        ];
    }

    public function tetesDeMort($enTete, $note = 0, $liens = false, $pathSansNote = "")
    {
        // opacité des têtes semi transparentes

        $opacite = 0.2;

        // choix des couleurs en fonction de la note de difficulté

        $rouge = 0;
        $vert = 0;
        $bleu = 0;

        if ($note == 0)
        {
            $rouge = 255;
            $vert = 255;
            $bleu = 255;
        }
        else
        {
            $rouge = min(round(($note-1)*(255/4.5)), 255);
            $vert = min(round((10-$note)*(255/4.5)), 255);
            $bleu = 0;
        }

        // choix des mots en fonction de la note

        $mots = "";

        switch ($note) {
            case 1:
                $mots = "initiation";
                break;
            case 2:
                $mots = "débutant";
                break;
            case 3:
                $mots = "facile";
                break;
            case 4:
                $mots = "y'a du niveau !";
                break;
            case 5:
                $mots = "pas mal !";
                break;
            case 6:
                $mots = "connaisseur";
                break;
            case 7:
                $mots = "maitrîse";
                break;
            case 8:
                $mots = "pro";
                break;
            case 9:
                $mots = "hardcore !";
                break;
            case 10:
                $mots = "légendaire";
                break;
            default:
                $mots = "";
                break;
        }



        // création du code html à renvoyer

        $html = "";

        // création du paragraphe et application des couleurs
        $html .= "<p style=\"color : rgb(" . $rouge . ", " . $vert . ", " . $bleu . ")\">";

        // en tête de la colonne
        $html .= "<span>" . $enTete . "</span><br />";

        // gestion des liens de notation s'il s'agit de la colonne prévue à cet effet
        if ($liens)
            $html .= "<span class=\"tetes\">";
        
        // icones opaques
        for ($i=1 ; $i<=$note ; $i++)
        {
            if ($liens)
            {
                // préparation path : remplacement du 0 mit par défaut
                $longueurPath = strlen($pathSansNote);
                $pathSansNote = substr(0, $longueurPath - 1);
                $path = $pathSansNote . $i;

                // href avec path
                $html .= "<a href=\"";
                $html .= $path;
                $html .= "\"";

                // style
                $html .= "style=\"color : rgb(" . $rouge . ", " . $vert . ", " . $bleu . ")\"";

                // id
                $html .= " id=\"teteDeMortUtilisateur" . $i . "\">";
            }
            
            // icone
            $html .= "<i class=\"fas fa-skull-crossbones";
            if ($liens)
                $html .= " teteColoree tete";
            $html .= "\"></i>";

            // fermeture lien
            if ($liens)
                $html .= "</a>";

            // espace entre les têtes
            $html .= "\n";
            
        }

        // éventuelles icones semi transparentes
        if ($note != 10)
        {
            for ($i=1; $i < 10-$note; $i++)
            { 
                if ($liens)
                {
                    // préparation path : remplacement du 0 mit par défaut
                    $longueurPath = strlen($pathSansNote);
                    $pathSansNote = substr(0, $longueurPath - 1);
                    $path = $pathSansNote . ($i + $note);

                    // href
                    $html .= "<a href=\"";
                    $html .= $path;
                    $html .= "\"";
                    
                    // id
                    $html .= " id=\"teteDeMortUtilisateur{{ difficulteUtilisateurCourant.note + i }}\">";
                }
                
                // icones
                
                // class
                $html .= "<i class=\"fas fa-skull-crossbones";
                if ($liens)
                $html .= " teteColoree tete";
                $html .= "\"";
                
                // style
                $html .= " style=\"color : rgba(" . $rouge . ", " . $vert . ", " . $bleu . ", " . $opacite . ")\"></i>";
    
                // fermeture lien
                if ($liens)
                    $html .= "</a>";

                // espace entre les têtes
                $html .= "\n";
            }
        }

        if ($liens)
        $html .= "</span>";
        
        $html .= "<br />";
        
        // commentaires relatifs à la difficulté (ici $mots)

        if ($liens)
            $html .= "<span id=\"commentaireDifficulte\">";
        else
            $html .= "<span>";
        
        $html .= $mots;
        
        // fermeture commentaire
        $html .= "</span>";

        // fermeture de toute la partie générée
        $html .= "</p>";

        return $html;
    }
}