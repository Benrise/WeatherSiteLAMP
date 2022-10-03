<?php
if (isset($_GET['form'])){
    $form_parameter = $_GET['form'];
    switch ($form_parameter) {
        # rect
        case 1:
            $xRadiusRect = intval($_GET['radius-input'])/2;
            $yRadiusRect = intval($_GET['radius-input'])/2;
            if (isset($_GET['proportions'])){

                $widthRect = intval($_GET['size-input'])*0.7;
                $heightRect = $widthRect;
            }
            else {
                $widthRect = $_GET['size-input'];
                $heightRect = intval($_GET['size-input'])*0.7;
            }
            $color = $_GET['color'];
            break;
        # ellipse
        case 2:
            $xRadiusEllipse = intval($_GET['size-input'])*0.5;
            $yRadiusEllipse = intval($_GET['size-input'])*0.25;
            $color = $_GET['color-input'];
            break;
        # circle
        case 3:
            $radius = intval($_GET['size-input'])/3;
            $color = $_GET['color-input'];
            break;
        default:
            return;
    }
}

if (isset($_GET['figure']))
{
    $figure = intval($_GET['figure']);
    switch($figure){
        case 1:
            $xRadiusRect = 10;
            $yRadiusRect = 10;
            $widthRect = 400;
            $heightRect = 250;
            $color = "purple";
            break;
        case 2:
            $xRadiusEllipse = 350;
            $yRadiusEllipse = 200;
            $color = "red";
            break;
        case 3:
            $radius = 250;
            $color = "orange";
            break;
        default:
            return;
    }
}


include ('drawer.php');
?>

