<?php
require_once("authentication/db_connect.php");
session_start();
if (isset($_SESSION['user'])) {
    header('Location: login.en.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="/css/<?php echo @$_COOKIE['theme'];?>">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>

<!-- Форма регистрации -->

<form action="authentication/signup.php" method="post" enctype="multipart/form-data">
    <label>Full name</label>
    <input type="text" name="full_name" placeholder="Full name">
    <label>Username</label>
    <input type="text" name="login" placeholder="Enter your username">
    <label>E-mail</label>
    <input type="email" name="email" placeholder="E-mail">
    <label>Profile picture</label>
    <input type="file" name="avatar">
    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    <label>Password confirm</label>
    <input type="password" name="password_confirm" placeholder="Confirm password">
    <button type="submit">Enter</button>
    <p>
        Already in? - <a href="http://localhost/login.en.php">log in</a>!
    </p>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>

</body>
</html>