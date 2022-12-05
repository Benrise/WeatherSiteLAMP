<?php
session_start();
require_once 'db_connect.php';
$login = $_POST['login'];
$password = md5($_POST['password']);
$check_user = mysqli_query($GLOBALS['connect'], "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
$userTheme = substr_replace(session_id(),"PHPREDIS_THEME:",0, 0);
redisSet($userTheme, "sky-theme.css");
if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
            "avatar" => $user['avatar'],
            "email" => $user['email'],
            "login" => $user['login']
        ];
        $_SESSION['theme'] = redisGet("userTheme");
        // Определенение предыдущей страницы с помощью COOKIE
        if (isset($_COOKIE["lastPage"])){
            if ($_COOKIE["lastPage"] == "cities")
            {
                header('Location: ../cities.php');
            }
            else if ($_COOKIE["lastPage"] == "sixteen"){
                header('Location: ../sixteen.php');
            }
            else if ($_COOKIE["lastPage"] == "history"){
                header('Location: ../history.php');
            }
            else if ($_COOKIE["lastPage"] == "weatherMap"){
                header('Location: ../weatherMap.php');
            }
        }
        else {
            header('Location: ../index.html');
        }

    }
else
    {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../login.php');
    }
?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>