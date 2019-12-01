$(function(){
    $champsRecherche = $("#recherche");

    $lignesUtilisateurs = $(".trUtilisateur");

    $champsRecherche.keyup(function(){
        $aChercher = $champsRecherche.val();
        $lignesUtilisateurs.each(function(index, element){
            $login = jQuery(element).children().first().text();
            if ($login.indexOf($aChercher) >= 0){
                jQuery(element).show();
            } else {
                jQuery(element).hide();
            }
        });
    });
});