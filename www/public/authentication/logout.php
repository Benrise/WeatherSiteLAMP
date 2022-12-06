<?php
require_once("db_connect.php");
session_start();
unset($_SESSION['user']);
session_destroy();
header('Location: ../login.php');
