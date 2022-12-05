<?php header('content-type: text/css');
$themes = array (
    '1' => "linear-gradient(to right, #0acffe 0%, #495aff 100%)", //blue
    '2' => "linear-gradient(to right, #f5f5f5 0%, rgb(254, 148, 10) 100%)" //orange
);

$selectedTheme = $themes[intval($_POST['select-theme'],10)];
?>

.body
{
    background-image: <?php  echo $selectedTheme?>;
    background-attachment: fixed;
}