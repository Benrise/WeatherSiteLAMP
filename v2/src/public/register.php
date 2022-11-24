<?php
if (isset($_POST["register"])) {
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $connection = new mysqli("MYSQL", "user", "password", "appDB");
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $query_result = $connection->query("SELECT * FROM users WHERE username='" . $username . "'");
        $result = $query_result->fetch_row();
        if (!empty($result)) {
            echo '<script language="javascript">';
            echo 'alert("User with this username already exists")';
            echo '</script>';
        } else {
            $password = crypt($password);
            $stmt = $connection->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $username, $password, $email);
            $stmt->execute();
            echo '<script language="javascript">';
            echo 'window.location.replace("login.php");';
            echo '</script>';
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="style.css" media="screen" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" action="register.php" method="post">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" id="username" name="username" class="login__input" placeholder="User name">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="text" class="login__input" id="email" name="email" placeholder="Email">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="login__input" placeholder="Password">
                </div>
                <span class="button__text"> <i class="button__icon fas fa-chevron-right"><input
                                class="button login__submit" type="submit" id="register" name="register"
                                VALUE="Sign up"></i></span>

            </form>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
</body>
</html>

