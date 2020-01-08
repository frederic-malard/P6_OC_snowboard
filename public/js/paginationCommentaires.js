$(function(){

    $commentaires = $(".commentaire");

    $debut = 0;
    $nombreCommentaires = $commentaires.length;
    $nbParPages = 10;

    $pageSuivanteDiv = $("#pageSuivante");

    $nbPages = Math.ceil($nombreCommentaires / $nbParPages);

    $afficher = function($debut, $nbParPages, $nombreCommentaires){
        if ($debut > 0){
            for (let i = 0; i < $debut; i++) {
                $commentaire = $commentaires[i];
                $commentaire = $($commentaire);
                $commentaire.hide();
            }
        }
        $fin = Math.min(($debut + $nbParPages - 1), ($nombreCommentaires - 1));
        for ($i = $debut; $i <= $fin; $i++) {
            $commentaire = $commentaires[$i];
            $commentaire = $($commentaire);
            $commentaire.show();
        }
        $debutSuite = $debut + $nbParPages;
        console.log($debutSuite + " " + $nombreCommentaires);
        if ($debutSuite < $nombreCommentaires){
            console.log("dans if");
            for ($i = $debutSuite; $i < $nombreCommentaires; $i++) {
                console.log("dans if dans for");
                $commentaire = $commentaires[$i];
                $commentaire = $($commentaire);
                $commentaire.hide();
            }
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
            $lien.attr("onclick", ("afficher(" + ($i * $nbParPages)));
            $lien.text($i+1);

            $page.append($lien);
            $pageSuivanteDiv.insterBefore($page);
        }
    }

});