<?php
$connect = mysqli_connect('database', 'root', 'tiger', 'authDB');

if (!$connect) {
    die('Error connect to DataBase');
}