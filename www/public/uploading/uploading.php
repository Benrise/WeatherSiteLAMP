<?php

require_once ('../authentication/db_connect.php');
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: http://localhost/login.en.php');
    return;
}
if (!empty($_FILES['pdf'])){
    $file = $_FILES['pdf'];
    $name = $file['name'];
    $type = $file['type'];
    $path = $file['tmp_name'];
    $error =$file['error'];
    $size = $file['size'];
    $save_path = './uploads/' . time() . $name;
    if($type!="application/pdf"){
        $_SESSION['type_message'] = "Неверный формат файла!";
    }
    else if (!move_uploaded_file($path, '../' . $save_path)){
        $_SESSION['type_message'] = 'Ошибка при загрузке файла в хранилище';
    }
    else{
        $id = $_SESSION['user']['id'];
        redisRpush($id, $save_path);
        $_SESSION['type_message'] = 'Файл успешно загружен!';
        $_SESSION['files'][] = $name;
    }
}

//-------------------------------------------------------\\
//$_SERVER['HTTP_REFERER'] - НЕ ИСПОЛЬЗОВАТЬ - НЕБЕЗОПАСНО
header('Location: ' . $_SERVER['HTTP_REFERER']);

//rpush pics:**id** **pic_path1** **pic_path2** **pic_path3**

//rpush pics:23 path1 path2 path3
//(integer) 3
//lindex pics:23 0
//"path1"

