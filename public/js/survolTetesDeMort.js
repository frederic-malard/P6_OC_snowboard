$(function(){

    $whenEnter = function(event){
        $target = jQuery(event.target);

        if($target.prop("tagName") == "path")
            $target = $target.parent();

        $id = $target.parent().attr("id");
        $longueurId = $id.length;
        $num = $id.substring(21, $longueurId);

        $commentaireDifficulte = $("#commentaireDifficulte");
        switch (parseInt($num)) {
            case 1:
                $commentaireDifficulte.text("initiation");
                break;
            case 2:
                $commentaireDifficulte.text("débutant");
                break;
            case 3:
                $commentaireDifficulte.text("facile");
                break;
            case 4:
                $commentaireDifficulte.text("y'a du niveau !");
                break;
            case 5:
                $commentaireDifficulte.text("pas mal !");
                break;
            case 6:
                $commentaireDifficulte.text("connaisseur");
                break;
            case 7:
                $commentaireDifficulte.text("maitrîse");
                break;
            case 8:
                $commentaireDifficulte.text("pro");
                break;
            case 9:
                $commentaireDifficulte.text("hardcore !");
                break;
            case 10:
                $commentaireDifficulte.text("légendaire");
                break;
            default:
                break;
        }

        $rouge = Math.min(Math.round(($num-1)*(255/4.5)), 255);
        $vert = Math.min(Math.round((10-$num)*(255/4.5)), 255);

        $target.parent().parent().parent().children().css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");
        $target.parent().prevAll().children().css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");
        $target.parent().nextAll().children().css("color", "rgba(" + $rouge + ", " + $vert + ", 0, 0.2)");
        if ($id <= 5)
            $target.parent().next().prev().children().css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");
        else
            $target.parent().prev().next().children().css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");
    };

    $whenLeave = function(event){
        $target = jQuery(event.target);

        if($target.prop("tagName") == "path")
            $target = $target.parent();

        $id = $target.parent().attr("id");
        $longueurId = $id.length;
        $num = $id.substring(21, $longueurId);

        if ($(".teteGrise").length > 0){
            $commentaireDifficulte = $("#commentaireDifficulte");
            $commentaireDifficulte.text("");

            $target.parent().parent().parent().children().css("color", "white");

            $(".teteGrise").each(function(cle, element){
                $element = jQuery(element);
                //if ($element.parent().attr("id") <= 5)
                if (cle == 0)
                    $element.parent().next().prev().children().css("color", "rgba(255, 255, 255, 0.2)");
                else
                    $element.parent().prev().next().children().css("color", "rgba(255, 255, 255, 0.2)");
            });
        } else {
            $num = $(".teteColoree").length;

            $commentaireDifficulte = $("#commentaireDifficulte");
            switch (parseInt($num)) {
                case 1:
                    $commentaireDifficulte.text("initiation");
                    break;
                case 2:
                    $commentaireDifficulte.text("débutant");
                    break;
                case 3:
                    $commentaireDifficulte.text("facile");
                    break;
                case 4:
                    $commentaireDifficulte.text("y'a du niveau !");
                    break;
                case 5:
                    $commentaireDifficulte.text("pas mal !");
                    break;
                case 6:
                    $commentaireDifficulte.text("connaisseur");
                    break;
                case 7:
                    $commentaireDifficulte.text("maitrîse");
                    break;
                case 8:
                    $commentaireDifficulte.text("pro");
                    break;
                case 9:
                    $commentaireDifficulte.text("hardcore !");
                    break;
                case 10:
                    $commentaireDifficulte.text("légendaire");
                    break;
                default:
                    break;
            }
            
            $rouge = Math.min(Math.round(($num-1)*(255/4.5)), 255);
            $vert = Math.min(Math.round((10-$num)*(255/4.5)), 255);

            $target.parent().parent().parent().children().css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");

            $(".teteColoree").each(function(cle, element){
                $element = jQuery(element);
                $element.css("color", "rgb(" + $rouge + ", " + $vert + ", 0)");
            });

            $(".teteTransparente").each(function(cle, element){
                $element = jQuery(element);
                $element.css("color", "rgba(" + $rouge + ", " + $vert + ", 0, 0.2)");
            });
        }
    };

    $(".tete").hover($whenEnter, $whenLeave);
});