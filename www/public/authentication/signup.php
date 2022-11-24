<?php

session_start();
require_once 'db_connect.php';

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {

    $password = md5($password);

    mysqli_query($GLOBALS['connect'], "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES (NULL, '$full_name', '$login', '$email', '$password')");

    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../profile.php');


} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: register.php');
}

?>