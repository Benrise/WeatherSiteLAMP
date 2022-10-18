<html lang="en">
<head>
    <title>Shell Sort</title>
    <link rel="stylesheet" href="/assets/css/sort.css?" type="text/css"/>
</head>
<body>
<main>
    <a id = "index" href="http://localhost"><h1></h1></a>
    <h2>Сортировка алгоритмом Шелла</h2>
    <p>Входные данные:</p>
    <form action = "shellSort-backend.php" method="get">
        <input type="text"
               id = "nums-area"
               class = "nums-area"
               name = "toSort"
               value="<?php if (isset($_GET["toSort"])) echo $_GET["toSort"]?>"
               onkeypress='validate(event)'>
        <br>
        <br>
        <input id="sort-button" type="submit" value="Сортировать" >
        <input id="clear-button" type="button" value="Очистить" >
        <div class="sorted-wrapper" >
            <p>Отстортированные данные:</p>
            <input type="text"
                   class = "nums-area"
                   name = "sorted"
                   value="<?php if (isset($_GET["sorted"])) foreach ($sorted as $num) echo $num, ' '?> "
                   readonly>
        </div>
    </form>
</main>
</body>
</html>
<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\ /;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
    document.getElementById("clear-button").onclick = function(event) {
        document.getElementById("nums-area").value = "";
    }
</script>
