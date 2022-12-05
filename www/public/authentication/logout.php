<?php
require_once("db_connect.php");
session_start();
unset($_SESSION['user']);
unset($_SESSION['theme']);
session_destroy();
redisClear();
header('Location: ../login.php');
