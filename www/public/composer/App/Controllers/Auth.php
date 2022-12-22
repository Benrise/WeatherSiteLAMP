<?php

namespace App\Controllers;
namespace App\Services;


class Auth
{
    public function register($data, $files){
        session_start();
        $full_name = $data['full_name'];
        $login = $data['login'];
        $email = $data['email'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm'];

        if ($password === $password_confirm) {

//            setcookie('theme', 'sky-theme.css', '../');
            $password = md5($password);
            mysqli_query(App::$connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', null)");
            $_SESSION['message'] = 'Регистрация прошла успешно! Теперь вам доступны настройки сайта! Взгляните на фон страницы!';
            header('Location: ../profile.php');


        } else {
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: /register');
        }


    }

}