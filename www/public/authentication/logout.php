<?php
require_once("db_connect.php");
session_start();
unset($_SESSION['user']);
setcookie('theme', '',0, '/', '', false, false);
session_destroy();
header('Location: ../login.php');
