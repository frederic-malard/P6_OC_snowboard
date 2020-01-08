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

    $afficher($debut, $nbParPages, $nombreCommentaires);

    $paginationDiv = $("#paginationDiv");

    if ($nombreCommentaires < $nbParPages){
        $paginationDiv.hide();
    } else {
        for ($i = 0; $i < $nbPages; $i++) {
            $page = $("<li></li>");
            $page.addClass("page-item");
            if ($i == 0)
                $page.addClass("active");

            $lien = $("<a></a>");
            $lien.addClass("page-link");
            $lien.attr("href", "#");
            $lien.attr("onclick", ("(function(event){event.preventDefault()})(event); $afficher(" + ($i * $nbParPages) + ", " + $nbParPages + ", " + $nombreCommentaires + ")"));
            $lien.text($i+1);

            $page.insertBefore($pageSuivanteDiv);
            $page.append($lien);
        }

        $pagePrecedenteDiv.click(function(event){
            event.preventDefault();
            $afficher($debutPrecedent, $nbParPages, $nombreCommentaires);
        });

        $pageSuivanteDiv.click(function(event){
            event.preventDefault();
            $afficher($debutSuivant, $nbParPages, $nombreCommentaires);
        });
    }

});