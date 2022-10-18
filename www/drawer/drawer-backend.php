<?php
if (isset($_POST['form'])){
    $form_parameter = $_POST['form'];
    switch ($form_parameter) {
        # rect
        case 1:
            $xRadiusRect = intval($_POST['radius-input'])/2;
            $yRadiusRect = intval($_POST['radius-input'])/2;
            if (isset($_POST['proportions'])){

                $widthRect = intval($_POST['size-input'])*0.7;
                $heightRect = $widthRect;
            }
            else {
                $widthRect = $_POST['size-input'];
                $heightRect = intval($_POST['size-input'])*0.7;
            }
            $color = $_POST['color'];
            break;
        # ellipse
        case 2:
            $xRadiusEllipse = intval($_POST['size-input'])*0.5;
            $yRadiusEllipse = intval($_POST['size-input'])*0.25;
            $color = $_POST['color-input'];
            break;
        # circle
        case 3:
            $radius = intval($_POST['size-input'])/3;
            $color = $_POST['color-input'];
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

