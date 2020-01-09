$(function(){

    $commentaires = $(".commentaire");

    $debut = 0;
    $nombreCommentaires = $commentaires.length;
    $nbParPages = 10;
    $debutSuivant = 10;
    $debutPrecedent = 0;

    $pageSuivanteDiv = $("#pageSuivante");
    $pagePrecedenteDiv = $("#pagePrecedente");

    $nbPages = Math.ceil($nombreCommentaires / $nbParPages);

    $afficher = function($debut, $nbParPages, $nombreCommentaires){
        if ($debut > 0){
            for (let i = 0; i < $debut; i++) {
                $commentaire = $commentaires[i];
                $commentaire = $($commentaire);
                $commentaire.hide();
            }
        }
        if ($debut > 10)
            $debutPrecedent = $debut - 10;
        else
            $debutPrecedent = 0;
        $fin = Math.min(($debut + $nbParPages - 1), ($nombreCommentaires - 1));
        for ($i = $debut; $i <= $fin; $i++) {
            $commentaire = $commentaires[$i];
            $commentaire = $($commentaire);
            $commentaire.show();
        }
        $debutSuite = $debut + $nbParPages;
        if ($debutSuite < $nombreCommentaires){
            for ($i = $debutSuite; $i < $nombreCommentaires; $i++) {
                $commentaire = $commentaires[$i];
                $commentaire = $($commentaire);
                $commentaire.hide();
            }
            $debutSuivant = $debutSuite;
        }
    };

    $changerNavPages = function($debut, $nbParPages){
        $(".active").removeClass("active");
        $numPage0 = Math.ceil($debut / $nbParPages); // numéro de la page en comptant à partir de 0
        $($(".num-page")[$numPage0]).addClass("active");
        if($numPage0 === 0)
            $("#pagePrecedente").addClass("disabled");
        else
            $("#pagePrecedente").removeClass("disabled");
        if($numPage0 === $nbPages - 1)
            $("#pageSuivante").addClass("disabled");
        else
            $("#pageSuivante").removeClass("disabled");
    }

    $afficher($debut, $nbParPages, $nombreCommentaires);

    $paginationDiv = $("#paginationDiv");

    if ($nombreCommentaires < $nbParPages){
        $paginationDiv.hide();
    } else {
        for ($i = 0; $i < $nbPages; $i++) {
            $page = $("<li></li>");
            $page.addClass("page-item");
            $page.addClass("num-page");
            if ($i == 0)
                $page.addClass("active");

            $lien = $("<a></a>");
            $lien.addClass("page-link");
            $lien.attr("href", "#");
            $lien.attr("onclick", ("(function(event){event.preventDefault()})(event); $afficher(" + ($i * $nbParPages) + ", " + $nbParPages + ", " + $nombreCommentaires + "); $changerNavPages(" + ($i * $nbParPages) + ", " + $nbParPages + ")"));
            $lien.text($i+1);

            $page.insertBefore($pageSuivanteDiv);
            $page.append($lien);
        }

        $pagePrecedenteDiv.click(function(event){
            event.preventDefault();
            $afficher($debutPrecedent, $nbParPages, $nombreCommentaires);
            $changerNavPages($debutPrecedent, $nbParPages);
        });

        $pageSuivanteDiv.click(function(event){
            event.preventDefault();
            $afficher($debutSuivant, $nbParPages, $nombreCommentaires);
            $changerNavPages($debutSuivant, $nbParPages);
        });
    }

});