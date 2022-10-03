<?php
libxml_use_internal_errors( true );
$dom=new DOMDocument;
$dom->validateOnParse=false;
$dom->recover=true;
$dom->strictErrorChecking=false;
$dom->loadHTMLFile( "terminal-clear.php" );
$errors = libxml_get_errors();
libxml_clear_errors();

/* write changes back to the html file - ie: save */
$dom->saveHTMLFile( "terminal.php" );

include "terminal-clear.php";
include "terminal.php";

?>