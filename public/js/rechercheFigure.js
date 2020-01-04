$(function(){

    /**************************
     * 
     * FILTRES ET RECHERCHES
     * 
     **************************/

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
        $configurationTri();
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
    
    /**********************************
     * 
     * TRIS FIGURES
     * 
     **********************************/

    // implémentation quicksort

    // note : dans commentaires et noms variables, ordre doit être considéré inverse pour les explications si $ordreCroissant est à false
    $partition = function($tableau, $debut, $fin, $ordreCroissant){
        $valeurReference = $tableau[$fin][1]; // valeur qui va scinder la partition du tableau : à gauche, toutes les valeurs inférieurs ou égales, à droite, toutes les plus grandes strictement
        $indiceDernierInferieur = $debut - 1; // indice de la dernière case telle que, entre debut et indiceDernierInferieur, toutes les valeurs sont plus petites que valeurReference. Se déplace au fil du tri. Commence à -1 car au début, aucune case n'est validée comme étant inférieure.
        for ($indiceARanger = $debut ; $indiceARanger < $fin ; $indiceARanger++) // note : entre indiceARanger et fin-1, les valeurs sont en vrac et à ranger. Entre indiceDernierInferieur+1 et indiceARanger-1, les valeurs sont supérieurs strictement à valeurReference
        {
            if ($ordreCroissant)
                $condition = ($tableau[$indiceARanger][1] <= $valeurReference);
            else
                $condition = ($tableau[$indiceARanger][1] > $valeurReference);
            if ($condition)
            {
                $indiceDernierInferieur++;
                // échange du premier supérieur (juste après le dernier inférieur), et du premier non trié (indiceARanger), qui, selon la condition, est inférieur à la valeur référence. Ainsi, on aggrandit la zone des inférieurs.
                $tampon = $tableau[$indiceDernierInferieur];
                $tableau[$indiceDernierInferieur] = $tableau[$indiceARanger];
                $tableau[$indiceARanger] = $tampon;
            }
        }
        // échange du premier supérieur (après le dernier inférieur) et de la valeur référence. La valeur référence est ainsi placée entre les valeurs plus petites (placées avant elle) et les plus grande (après elle)
        $tampon = $tableau[$indiceDernierInferieur + 1];
        $tableau[$indiceDernierInferieur + 1] = $tableau[$fin];
        $tableau[$fin] = $tampon;

        return $indiceDernierInferieur + 1; // correspond au nouvel indice de la valeur référence, qui sépare la partition en deux partitions plus petites
    };

    $quicksort = function($tableau, $debut, $fin, $ordreCroissant){
        if ($debut < $fin){
            $pivot = $partition($tableau, $debut, $fin, $ordreCroissant); // indice de la case pour laquelle : soit x sa valeur, une fois la fonction partition achevée, toute case précédent la case pivot contient une valeur plus petite que x ou égale, toute case suivant contient une plus grande strictement
            $quicksort($tableau, $debut, ($pivot-1), $ordreCroissant); // on relance quicksort récursivement sur les cases entre la case "debut" et le pivot pour trier cette partie du tableau
            $quicksort($tableau, ($pivot+1), $fin, $ordreCroissant); // analogue
        }
    };

    
    // fonctions de tri
    
    $tri = function($classe, $ordreCroissant){
        // créé le tableau a trier avec les valeurs et les id
        tableau = [];

        $(".figure").each(function(){
            $avecEspaces = ($(this).find($classe)[0]).textContent;
            $regex = /[0-9]+/g;

            $resultat = $regex.exec($avecEspaces);

            if ($resultat == null){ // les difficultes ne sont pas indiquees (donc regex cherchant nombre vaut null) quand les difficultes ne sont pas présentes. Nombre favoris en revanche n'est jamais null donc pas à considérer ici.
                if($ordreCroissant)
                $nombre = 11; // range les non notés à la fin
                else
                $nombre = 0; // range les non notés à la fin
            } else {
                $nombre = parseInt($resultat[0]);
            }

            $case = [];
            $case.push($(this).attr("id"));
            $case.push($nombre);

            tableau.push($case);
        });

        // tri le tableau
        $quicksort(tableau, 0, (tableau.length - 1), $ordreCroissant);

        // ranger les éléments divs en fonction du tableau
        tableau.forEach(element => (function(element){
            $id = element[0];

            $(".figure#"+$id).detach().appendTo($(".figures"));
        })(element));
    };
    
    // choix de la fonction de tri

    $configurationTri = function(){
        if (typeof $("input[type=radio][name=typeTri]:checked")[0] !== "undefined"){
            $triSelectionne = $("input[type=radio][name=typeTri]:checked")[0].value;
    
            if ($triSelectionne == "triDate"){
                if ($("input[type=radio][name=ordreDate]:checked")[0].value == "recenteDabord"){
                    $tri(".dateCreation", false);
                } else {
                    $tri(".dateCreation", true);
                }
            } else if ($triSelectionne == "triDifficulteEditeur"){
                if ($("input[type=radio][name=ordreDifficulteEditeur]:checked")[0].value == "difficilesDabordEditeur"){
                    $tri(".noteEditeur", false);
                } else {
                    $tri(".noteEditeur", true);
                }
            } else if ($triSelectionne == "triDifficulteAutres"){
                if ($("input[type=radio][name=ordreDifficulteAutres]:checked")[0].value == "difficilesDabordAutres"){
                    $tri(".noteMoyenneSansEditeur", false);
                } else {
                    $tri(".noteMoyenneSansEditeur", true);
                }
            } else if ($triSelectionne == "triFavoris"){
                if ($("input[type=radio][name=ordreFavoris]:checked")[0].value == "succesDabord"){
                    $tri(".nbInteresses", false);
                } else {
                    $tri(".nbInteresses", true);
                }
            } else {
                console.log("dans else");
            }
        }
    };
    
    
    // listeners, lancement choix
    
    $("input[type=radio][name=typeTri]").change(function(){
        $actions();
    });
    
    // idem pour changement ordres, ssi la valeur de typetri correspond, sinon ne pas lancer de tri
    
    $("input[type=radio][name=ordreDate]").change(function(){
        if ($("input[type=radio][name=typeTri]:checked")[0].value == "triDate"){
            $actions();
        }
    });
    
    $("input[type=radio][name=ordreDifficulteEditeur]").change(function(){
        if ($("input[type=radio][name=typeTri]:checked")[0].value == "triDifficulteEditeur"){
            $actions();
        }
    });
    
    $("input[type=radio][name=ordreDifficulteAutres]").change(function(){
        if ($("input[type=radio][name=typeTri]:checked")[0].value == "triDifficulteAutres"){
            $actions();
        }
    });
    
    $("input[type=radio][name=ordreFavoris]").change(function(){
        if ($("input[type=radio][name=typeTri]:checked")[0].value == "triFavoris"){
            $actions();
        }
    });

});