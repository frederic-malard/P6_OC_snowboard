$(function(){

    lastIndex = 0;

    if ($('#figure_modif_nouvellesVideos').has('.form-group'))
    {
        $('#figure_modif_nouvellesVideos .form-group input').each(function(index, value)
        {
            $idBlock = $(value).attr('id');
            $longueurId = $idBlock.length;
            lastIndex = parseInt($idBlock.substring(19, $longueurId)) + 1;
        });
    }

    $('#ajoutVideo').click(function (){
        $('#figure_modif_nouvellesVideos').append($('#figure_modif_nouvellesVideos').data('prototype').replace(/__name__/g, lastIndex));
        handleDeleteButtons();
        lastIndex++;
    });

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