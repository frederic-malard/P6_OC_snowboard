$(function(){
    $commentaires = $("#commentaires");

    $commentairesAffiches = $('.d-block');
    $commentairesMasques = $('.d-none');
    $commentairesTotal = $('.commentaire');

    // s'il existe au moins un commentaire pour la figure en question
    if ($commentairesTotal.length > 0){
        $portionAffichage = 7;
    
        // gérer l'affichage de commentaires supplémentaires
        if ($commentairesMasques.length > 0) {
            $pBouton = $('<p></p>');
    
            $boutonAfficher = $('<button></button>');
            $boutonAfficher.text("Afficher plus");
    
            $commentaires.append($pBouton);
            $pBouton.append($boutonAfficher);
    
            $pBouton.addClass("m-3");
            $pBouton.addClass("text-center");
    
            $boutonAfficher.addClass("btn");
            $boutonAfficher.addClass("btn-primary");
    
            $boutonAfficher.click(function(){
                $cpt = $portionAffichage;
                $commentairesMasques.each(function(cle, commentaire) {
                    if ($cpt > 0) {
                        $(commentaire).removeClass("d-none");
                        $(commentaire).addClass("d-block"); // affiche au maximum $portionAffichage commentaires
    
                        $cpt--;
                    }
                });
    
                $commentairesAffiches = $('.d-block');
                $commentairesMasques = $('.d-none');
    
                // retire le bouton "afficher plus" si tous les commentaires sont affichées
                if ($commentairesMasques.length == 0) {
                    $boutonAfficher.addClass("d-none");
                }
            });
            
        }
    }
});