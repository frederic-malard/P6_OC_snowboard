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

    // masquer les notés (en difficulté) par l'éditeur, les autres, ou l'utilisateur (en fonction du paramètre) avec une note hors de l'intervalle

    $masquerDifficulte = function($typeNote){
        $minDifficulte = parseInt($("#minDifficulte"+$typeNote).val());
        $maxDifficulte = parseInt($("#maxDifficulte"+$typeNote).val());
        $inclureNonNotes = $("#inclureNonNotes"+$typeNote).is(":checked") ? true : false;

        $figures.each(function(){
            $noteAvecEspaces = ($(this).find(".note"+$typeNote)[0]).textContent;
            $regex = /[0-9]+/g;
            $reponses = $regex.exec($noteAvecEspaces);
            $note = null;
            if ($reponses != null)
                $note = parseInt($reponses[0]);
            if (((! $inclureNonNotes) && $note == null) || ($note != null && ($note < $minDifficulte || $note > $maxDifficulte))){
                $(this).removeClass("d-block");
                $(this).addClass("d-none");
            }
        });
    };

    // masquer les figures qui ne sont pas dans les favoris de l'utilisateur courant

    $masquerFavorisPerso = function(){
        $checkbox = $("#dansMesFavoris");
        $estCoche = $checkbox.is(":checked");
        if ($estCoche){
            $figures.each(function(){
                $interesseAvecEspaces = ($(this).find(".estInteresse")[0]).textContent;
                $regex = /[a-z]+/g;
                $interesseString = $regex.exec($interesseAvecEspaces)[0];
                $interesse = false;
                if ($interesseString == "oui")
                    $interesse = true;
                if ($estCoche && (! $interesse)){
                    $(this).removeClass("d-block");
                    $(this).addClass("d-none");
                }
            });
        }
    }

    // masquer les figures qui ne sont pas dans les favoris d'au moins x utilisateurs

    $masquerFavorisXUtilisateurs = function(){
        $nbInput = $("#nbMinFavoris");
        $nbMinFavoris = parseInt($nbInput.val());
        if ($nbMinFavoris > 0){
            $figures.each(function(){
                $nbInteressesAvecEspaces = ($(this).find(".nbInteresses")[0]).textContent;
                $regex = /[0-9]+/g;
                $nbInteresses = parseInt($regex.exec($nbInteressesAvecEspaces)[0]);
                if ($nbInteresses < $nbMinFavoris){
                    $(this).removeClass("d-block");
                    $(this).addClass("d-none");
                }
            });
        }
    }

    // actions à faire à chaque événement

    $actions = function(){
        $toutAfficher();
        $masquerRecherche();
        $masquerGroupes();
        $masquerDifficulte("Editeur");
        $masquerDifficulte("MoyenneSansEditeur");
        $masquerDifficulte("Perso");
        $masquerFavorisPerso();
        $masquerFavorisXUtilisateurs();
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

    // filtrer par difficulté éditeur

    $("#minDifficulteEditeur").change(function(){
        $actions();
    });
    $("#maxDifficulteEditeur").change(function(){
        $actions();
    });
    $("#inclureNonNotesEditeur").click(function(){
        $actions();
    });

    // filtrer par difficulté éditeur

    $("#minDifficulteMoyenneSansEditeur").change(function(){
        $actions();
    });
    $("#maxDifficulteMoyenneSansEditeur").change(function(){
        $actions();
    });
    $("#inclureNonNotesMoyenneSansEditeur").click(function(){
        $actions();
    });

    // filtrer par difficulté éditeur

    $("#minDifficultePerso").change(function(){
        $actions();
    });
    $("#maxDifficultePerso").change(function(){
        $actions();
    });
    $("#inclureNonNotesPerso").click(function(){
        $actions();
    });

    // filtrer les figures qui ne sont pas favorites de l'utilisateur courant ou de X utilisateurs au moins

    $("#dansMesFavoris").click(function(){
        $actions();
    });
    $("#nbMinFavoris").keyup(function(){
        $actions();
    });
    $("#nbMinFavoris").mouseup(function(){
        $actions();
    });

});