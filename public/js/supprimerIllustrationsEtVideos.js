$(function(){

    function handleDeleteButtons()
    {
        $('button[data-action="delete"]').click(function(){
            $(this.dataset.target).remove();
        });
    }

    handleDeleteButtons();

    // affichage illustrations (pas vidéo du coup)

    $("#figure_modif_nouvellesIllustrations").css("opacity", 1);

});