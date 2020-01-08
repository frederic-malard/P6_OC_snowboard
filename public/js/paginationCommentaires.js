$(function(){

    $commentaires = $(".commentaire");

    $debut = 0;
    $nombreCommentaires = $commentaires.length;
    $nbParPages = 10;

    $nbPages = Math.ceil($nombreCommentaires / $nbParPages);

    $afficher = function($debut, $nbParPages, $nombreCommentaires){
        if ($debut > 0){
            for (let i = 0; i < $debut; i++) {
                $commentaire = $commentaires[i];
                $commentaire.hide();
            }
        }
        $fin = Math.min(($debut + $nbParPages - 1), ($nombreCommentaires - 1));
        for ($i = $debut; $i <= $fin; $i++) {
            $commentaire = $commentaires[i];
            $commentaire.show();
        }
        $debutSuite = $debut + $nbParPages;
        if ($debutSuite < $nombreCommentaires){
            for ($i = $debutSuite; $i < $nombreCommentaires; $i++) {
                $commentaire = $commentaires[i];
                $commentaire.hide();
            }
        }
    };

    $afficher($debut, $nbParPages, $nombreCommentaires);

    $paginationDiv = $("#paginationDiv");

    if ($nombreCommentaires < $nbParPages){
        $paginationDiv.hide();
    } else {
        
    }

});