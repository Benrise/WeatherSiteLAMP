<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>Terminal</title><link rel="stylesheet" href="/assets/css/terminal.css?" type="text/css"></head><body>
<main><a id="index" href="http://localhost" onclick=""><h1></h1></a>
    <h2>&#1048;&#1085;&#1092;&#1086;&#1088;&#1084;&#1072;&#1094;&#1080;&#1086;&#1085;&#1085;&#1086;-&#1072;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1090;&#1080;&#1074;&#1085;&#1072;&#1103; &#1074;&#1077;&#1073;-&#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1072;</h2>
    <div class="terminal-container">
        <form action="terminal-backend.php" method="POST" style="padding: 5px; margin: 0px;">
            localhost:~<input id="command-input" class="command-input" type="text" name="code" placeholder="_"></form>
    </div>
    <form action="terminal-clear-backend.php" method="post" id = "index">
        <input type="submit" value="Очистить консоль" name = "clear"/>
    </form>


</main></body></html>