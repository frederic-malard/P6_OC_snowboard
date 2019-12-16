$(function(){

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

    // gestion de la recherche textuelle

    $champsRecherche = $("#recherche");

    $figures = $(".figure");

    $champsRecherche.keyup(function(){
        $aChercher = $champsRecherche.val();
        $figures.each(function(index, element){
            $nom = jQuery(element).children().first().children().last().children().last().text();
            if ($nom.indexOf($aChercher) >= 0){
                console.log("montre");
                jQuery(element).removeClass("d-none");
                jQuery(element).addClass("d-block");
            } else {
                console.log("cache");
                jQuery(element).addClass("d-none");
                jQuery(element).removeClass("d-block");
            }
        });
    });
});