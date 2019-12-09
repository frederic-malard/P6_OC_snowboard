$(function(){

    $(".tete").mouseenter(function(event){
        $target = jQuery(event.target);
        $target.parent().prevAll().children().css("color", "white");
        $target.css("color", "white");
        $target.parent().nextAll().children().css("color", "black");
    });

    $(".tete").parent().mouseleave(function(){
        $(".teteColoree").each(function(cle, element){
            $element = jQuery(element);
            $element.css("color", "white");
        });
        $(".teteTransparente").each(function(cle, element){
            $element = jQuery(element);
            $element.css("color", "black");
        });
        $(".teteGrise").each(function(cle, element){
            $element = jQuery(element);
            $element.css("color", "grey");
        });
    });

    /*$target = null;

    $(".tete").mouseenter(function(event){
        $target = jQuery(event.target);
    });

    $(".tete").parent().mouseleave(function(){
        $target = null;
    });

    $changeCouleur = function (){
        if ($target == null){
            $(".teteColoree").each(function(cle, element){
                $element = jQuery(element);
                $element.css("color", "white");
            });
            $(".teteTransparente").each(function(cle, element){
                $element = jQuery(element);
                $element.css("color", "black");
            });
            $(".teteGrise").each(function(cle, element){
                $element = jQuery(element);
                $element.css("color", "grey");
            });
        } else {
            $target.parent().prevAll().children().css("color", "white");
            $target.css("color", "white");
            $target.parent().nextAll().children().css("color", "black");
        }
    };

    $interval = window.setInterval($changeCouleur, 333);*/

});