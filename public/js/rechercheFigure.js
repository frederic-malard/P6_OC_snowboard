$(function(){

    // préparation variables

    $inputGroupes = $(".filtreGroupe");
    $champsRecherche = $("#recherche");
    $figures = $(".figure");

    // fonction pour masquer le bouton afficher plus

    $masquerBouton = function(){
        $bouton = $("#boutonAfficherPlus");
        if (! $bouton.hasClass("d-none")) {
            $boutonAfficher.addClass("d-none");
        }
    };

    // afficher-masquer la zone de recherche tri filtre
    
    $blockRecherche = $("#blockRecherche");
    $blockRecherche.toggle();
    $(".fa-arrow-up").toggle();

    $("#toggleRecherche").click(function(event){
        event.preventDefault();

        $(".fa-arrow-up").toggle();
        $(".fa-arrow-down").toggle();

        $blockRecherche.toggle();
    });

    // tout afficher

    $toutAfficher = function(){
        $(".figure").removeClass("d-none");
        $(".figure").addClass("d-block");
    };

    // masquer ce qui ne correspond pas à la recherche textuelle (sauf si recherche vide)

    $masquerRecherche = function(){
        $aChercher = $champsRecherche.val();
        $figures.each(function(index, element){
            $nom = jQuery(element).children().eq(1).children().last().children().last().text().toLowerCase();
            if ($nom.toLowerCase().indexOf($aChercher) >= 0){
                // jQuery(element).removeClass("d-none");
                // jQuery(element).addClass("d-block");
            } else {
                jQuery(element).addClass("d-none");
                jQuery(element).removeClass("d-block");
            }
        });
    };

    // masquer ce qui ne correspond pas aux groupes sélectionnés (sauf si tout déselectionné)

    $masquerGroupes = function(){
        nomsGroupesCoches = [];
        nomsGroupesDecoches = [];
        $inputGroupes.each(function(cle, element){
            $inputGroupe = jQuery(element);
            if ($inputGroupe.is(":checked")) {
                nomsGroupesCoches.push($inputGroupe.attr("id"));
            } else {
                nomsGroupesDecoches.push($inputGroupe.attr("id"));
            }
        });
        $nombreCoches = nomsGroupesCoches.length;
        if ($nombreCoches == 0) {
            $(".figure").each(function(cle, element){
                $figure = jQuery(element);
                // $figure.show();
            });
        } else {
            $.each(nomsGroupesCoches, function(cle, element){
                nomGroupeCoche = element;
                $('.'+nomGroupeCoche).each(function(cle, element){
                    $figureCochee = jQuery(element);
                    // $figureCochee.show();
                    // $figureCochee.addClass("d-block");
                    // $figureCochee.removeClass("d-none");
                });
            });
            $.each(nomsGroupesDecoches, function(cle, element){
                nomGroupeDecoche = element;
                $('.'+nomGroupeDecoche).each(function(cle, element){
                    $figureDecochee = jQuery(element);
                    // $figureDecochee.hide();
                    $figureDecochee.addClass("d-none");
                    $figureDecochee.removeClass("d-block");
                });
            });
        }
    };

    // actions à faire à chaque événement

    $actions = function(){
        $toutAfficher();
        $masquerRecherche();
        $masquerGroupes();
        $masquerBouton();
    };

    // gestion de la recherche textuelle

    $champsRecherche.keyup(function(){
        $actions();
    });

    // filtrer par groupes

    $inputGroupes.each(function(cle, element){
        $inputGroupe = jQuery(element);
        $inputGroupe.click(function(event){
            $actions();
        });
    });


});