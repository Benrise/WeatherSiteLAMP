<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="/css/<?php echo @$_COOKIE['theme'];?>">
    <link rel = "stylesheet" type = "text/css" href = "./css/style.css">
    <link rel = "stylesheet" type = "text/css" href = "./css/normalize.css">
    <title>Погода</title>
    <!--Загрузка шрифтов-->

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
    <link href="./fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=559dfe93-fc2a-44ff-830e-8ed8ca51c764&lang=ru_RU" type="text/javascript"></script>
    <script src= "./js/moment-with-locales.js"></script>
    <script src="./js/moment-timezone-with-data.js"></script>
    <script src="./js/map.js"></script>
    <script src="./js/current.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/Chart.js"></script>

    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicons/favicon-16x16.png">
    <link rel="mask-icon" href="./img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <script>
        // функция определения языка пользователя на javascript
        function LanguageInfo(){
            let n = navigator;
            this.UALanguage = n.language ? n.language : n.browserLanguage ? n.browserLanguage : null;
        }


        let oLanguage = new LanguageInfo();
        switch (oLanguage.UALanguage) {
            case "ru":
                break;
            case "en":
                location.href="index.en.php";
                break;
            default:
                break;
        }



    </script>

</head>