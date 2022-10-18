<html lang="en">
<head>
    <title>Drawer</title>
    <link rel="stylesheet" href="/assets/css/drawer.css?" type="text/css"/>
</head>
<body>
<main>
    <section id="drawer-menu">
        <a id = "index" href="http://localhost"><h1></h1></a>
        <h2>Варианты использования:</h2>
        <p>1. Ввести значение фигуры в URL строке параметра get-запроса</p>
        <form action="drawer-backend.php" class="link-wrapper" method="get">
            <input type="hidden" name="figure" value="2">
            <p class ="link">http://localhost/drawer/drawer.php<input class="get" type="submit" value="?figure=2"></p>
        </form>
        <br>
        <p>2. Воспользоваться генератором SVG фигур:</p>
        <form action="drawer-backend.php" method="POST">
            <div class="generator-wrapper">
<!--                https://www.code.mu/ru/php/book/prime/forms/values-remaining/-->
                <div class="slider-wrapper"><p>Форма</p><input type="range"
                            name = "form"
                            value = "<?php if (isset($_POST['form'])) echo $_POST['form']; ?>"
                            id = "form-slider" min="1" max="3" step="1"
                            oninput="setInput(1)" ></div>
                <div class="slider-wrapper" id = "color-slider-wrapper"><p>Цвет </p><input type="color"
                            name = "color"
                            value = "<?php if (isset($_POST['color'])) echo $_POST['color']; ?>"
                            id = "color-slider"  min="0" max="10000" step="1" min="1" max="100"
                            oninput="setInput(2)"></div>
                <div class="slider-wrapper"><p>Размер </p><input type="range"
                            name = "size"
                            value = "<?php if (isset($_POST['size'])) echo $_POST['size']; ?>"
                            id = "size-slider"  min="1" max="750" step="1" min="1" max="100"
                            oninput="setInput(3)"></div>
                <div id="checkbox-wrapper"><input type="checkbox" id = "proportions-checkbox"name = "proportions" value="<?php if (isset($_POST['proportions'])) echo $_POST['proportions'] ?>" ><span id = "proportion-text">Сохранить пропорции</span></div>
                <div id="radius-slider-wrapper" class="slider-wrapper"><p>Радиус углов </p>
                    <input type="range"
                           name = "radius"
                           value = "<?php if (isset($_POST['radius'])) echo $_POST['radius'] ?>"
                           id = "radius-slider"  min="1" max="100" step="1" min="1" max="100"
                           oninput="setInput(4)">
                </div>
            </div>
            <br>
            <input type="text"
                   size="40"
                   placeholder="Форма"
                   value = "<?php if (isset($_POST['form-input'])) echo $_POST['form-input'] ?>"
                   name = "form-input" id = "form-input">
            <input type="text"
                   size="40"
                   placeholder="Цвет"
                   value = "<?php if (isset($_POST['color-input'])) echo $_POST['color-input'] ?>"
                   name = "color-input" id = "color-input">
            <input type="text"
                   size="40"
                   placeholder="Размер"
                   value = "<?php if (isset($_POST['size-input'])) echo $_POST['size-input'] ?>"
                   name = "size-input" id = "size-input">
            <input type="text"
                   size="40"
                   placeholder="Радиус углов"
                   value = "<?php if (isset($_POST['radius-input'])) echo $_POST['radius-input'] ?>"
                   name = "radius-input" id = "radius-input">
            <input type="submit" value="Готово">
        </form>
        <br>
        <br>
        <p>Формы фигур:</p>
        <ul>
            <li>Параметр 1 - Прямоугольник</li>
            <li>Параметр 2 - Эллипс</li>
            <li>Параметр 3 - Круг</li>
        </ul>
    </section>
    <section id="figure">
            <svg width="765px" height="765px">
                <rect x=100px y=0px
                      rx="<?php if (isset($xRadiusRect)) echo $xRadiusRect?>"
                      ry="<?php if (isset($yRadiusRect)) echo $yRadiusRect?>"
                      width="<?php if (isset($widthRect)) echo $widthRect?>"
                      height="<?php if (isset($heightRect)) echo $heightRect?>"
                      fill="<?php if (isset($color)) echo $color?>"/>
                <ellipse cx=382.5 cy=280
                         rx="<?php if (isset($xRadiusEllipse)) echo $xRadiusEllipse?>"
                         ry="<?php if (isset($yRadiusEllipse)) echo $yRadiusEllipse?>"
                         fill="<?php if (isset($color)) echo $color?>"/>
                <circle cx="382.5" cy=280
                        r="<?php if (isset($radius)) echo $radius?>"
                        fill="<?php if (isset($color)) echo $color?>"/>
            </svg >
    </section>
</main>
</body>
</html>
<script>
    function setInput(parameter){
        switch (parameter){
            case 1:
                document.getElementById("form-input").value = document.getElementById("form-slider").value;
                break
            case 2:
                document.getElementById("color-input").value = document.getElementById("color-slider").value;
                break
            case 3:
                document.getElementById("size-input").value = document.getElementById("size-slider").value;
                break
            case 4:
                document.getElementById("radius-input").value = document.getElementById("radius-slider").value;
                break
            default:
                return
        }
        setup()
    }
    function setup(){
        let currentForm = document.getElementById("form-slider").value
        switch (parseInt(currentForm)){
            case 1:
                document.getElementById("radius-slider").disabled = false;
                document.getElementById("proportions-checkbox").disabled = false;
                document.getElementById("checkbox-wrapper").style = "opacity: 1;";
                document.getElementById("radius-slider-wrapper").style = "opacity: 1;";
                document.getElementById("radius-input").disabled = false;
                break;
            case 2:
                document.getElementById("radius-slider").disabled = true;
                document.getElementById("proportions-checkbox").disabled = true;
                document.getElementById("radius-slider-wrapper").style = "opacity: 0.3;";
                document.getElementById("checkbox-wrapper").style = "opacity: 0";
                document.getElementById("radius-input").disabled = true;
                break;
            case 3:
                document.getElementById("radius-slider").disabled = true;
                document.getElementById("radius-slider-wrapper").style = "opacity: 0.3;";
                document.getElementById("proportions-checkbox").disabled = true;
                document.getElementById("checkbox-wrapper").style = "opacity: 0";
                document.getElementById("radius-input").disabled = true;
                break;
            default:
                return;
        }
    }
    setup()

</script>