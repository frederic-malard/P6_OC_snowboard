$(function(){
    $corps = $("#corps");
    $tricks = $('#tricks');

    $figuresAffichees = $('.d-block');
    $figuresMasquees = $('.d-none');
    $figuresTotal = $('.figure');

    $portionAffichage = 15;

    // gérer l'affichage de figures supplémentaires
    if ($figuresMasquees.length > 0) {
        $pBouton = $('<p></p>');

        $boutonAfficher = $('<button></button>');
        $boutonAfficher.text("Afficher plus");

        $corps.append($pBouton);
        $pBouton.append($boutonAfficher);

        $pBouton.addClass("m-3");
        $pBouton.addClass("text-center");

        $boutonAfficher.addClass("btn");
        $boutonAfficher.addClass("btn-primary");

        $flecheVersHautAffichee = false;

        $boutonAfficher.click(function(){
            $cpt = $portionAffichage;
            $figuresMasquees.each(function(cle, figure) {
                if ($cpt > 0) {
                    $(figure).removeClass("d-none");
                    $(figure).addClass("d-block"); // affiche au maximum $portionAffichage figures

                    $cpt--;
                }
            });

            $figuresAffichees = $('.d-block');
            $figuresMasquees = $('.d-none');

            // retire le bouton "afficher plus" si toutes les figures sont affichées
            if ($figuresMasquees.length == 0) {
                $boutonAfficher.addClass("d-none");
            }

            // gérer l'apparition de flêche au delà de 15 figures
            if (! $flecheVersHautAffichee) {
                $flecheVersHaut = $('<i></i>');
                $aFlecheVersHaut = $('<a></a>');
                $pFlecheVersHaut = $('<p></p>');

                $corps.append($pFlecheVersHaut);
                $pFlecheVersHaut.append($aFlecheVersHaut);
                $aFlecheVersHaut.append($flecheVersHaut);

                $pFlecheVersHaut.css("font-size", "2em");
                $pFlecheVersHaut.addClass("m-3");
                $pFlecheVersHaut.addClass("text-right");

                $aFlecheVersHaut.attr("href", "#tricks");

                //$flecheVersHaut.css("color", "#fea");
                $flecheVersHaut.addClass("fas");
                $flecheVersHaut.addClass("fa-arrow-up");

                $flecheVersHautAffichee = true;
            }

            //$gererModification();
            $gererSuppression();
        });
        
    }



    // confirmation modification figure

    /*$gererModification = function(){
        $lienModifier = $("#modifierFigure");

        $lienModifier.click(function(event){
            if (confirm("Etes vous sur de vouloir modifier la figure ?")){
                window.location.replace($pathModifier);
            }
        });
    };

    $gererModification();*/



    // confirmation suppression figure

    $gererSuppression = function(){
        $liensSupprimer = $('.supprimerFigure');
    
        $liensSupprimer.each(function(cle, lien){
            $lien = jQuery(lien);
            
            $lien.click(function(event){
                event.preventDefault();

                $lien = jQuery(event.target.parentNode);
                $slugFigure = $lien.attr('id');
                console.log($slugFigure);
                
                if (confirm("Etes vous sur de vouloir supprimer la figure ?")){
                    window.location.replace($pathSupprimer.substring(0, $pathSupprimer.length - 6) + $slugFigure);
                }
            });
        });
    };

    $gererSuppression();
});