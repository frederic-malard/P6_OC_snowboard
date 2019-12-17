$(function(){

    lastIndex = 0;

    if ($('#figure_video').has('.form-group'))
    {
        $('#figure_video .form-group input').each(function(index, value)
        {
            $idBlock = $(value).attr('id');
            $longueurId = $idBlock.length;
            lastIndex = parseInt($idBlock.substring(19, $longueurId)) + 1;
        });
    }

    $('#ajoutVideo').click(function (){
        $('#figure_videos').append($('#figure_videos').data('prototype').replace(/__name__/g, lastIndex));
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

    $("#figure_illustrations").css("opacity", 1);

});