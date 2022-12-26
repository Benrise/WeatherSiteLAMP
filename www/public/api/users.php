<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
$con = mysqli_connect('database', 'root', 'tiger', 'authDB');
$answer = array();
switch ($requestMethod) {
    case 'GET':
        if (empty(isset($_GET['id']))) {
            $result = $con->query("SELECT * FROM users;");
            while ($row = $result->fetch_assoc()) {
                $answer[] = $row;
            }
        } else {
            $query_result = $con->query("SELECT * FROM users WHERE ID = " . $_GET['id'] . ";");
            $result = $query_result->fetch_row();
            $answer = $result;
        }
        if (!empty($result)) {
            http_response_code(200);
            echo json_encode($answer);
        } else {
            http_response_code(204);
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $user = json_decode($json);
        if (!empty($user->{'login'}) && !empty($user->{'password'}) && !empty($user->{'email'}) && !empty($user->{'full_name'})) {
            $login = $user->{'login'};
            $password = $user->{'password'};
            $email = $user->{'email'};
            $full_name = $user->{'full_name'};

            $query_result = $con->query("SELECT * FROM users WHERE login='" . $login . "'");
            $result = $query_result->fetch_row();

            if (!empty($result)) {
                http_response_code(409);
            } else {
                $password = md5($password);
                mysqli_query($con, "INSERT INTO `users` (`full_name`, `login`, `email`, `password`) VALUES ('$full_name', '$login', '$email', '$password')");
                http_response_code(201);
            }
        } else {
            http_response_code(422);
        }
        break;
    case 'PUT':
        $json = file_get_contents('php://input');
        $user = json_decode($json);
        if (!empty($user->{'login'}) && !empty($user->{'email'})) {
            if (empty(isset($_GET['id']))) {
                http_response_code(422);
                var_dump ($_GET['id']);
            }
            else {
                $query_result = $con->query("SELECT * FROM users WHERE ID='" . $_GET['id'] . "'");
                $result = $query_result->fetch_row();
                if (!empty($result)) {
                    $query_result = $con->query("SELECT * FROM users WHERE login='" . $user->{'login'} . "' AND ID!='" . $_GET['id'] . "'");
                    $result = $query_result->fetch_row();
                    if (!empty($result)) {
                        http_response_code(409);
                    } else {
                        $con->query("UPDATE users SET login='" . $user->{'login'} . "', email='" . $user->{'email'} . "' WHERE ID='" . $_GET['id'] . "'");
                        http_response_code(200);
                    }
                } else {
                    http_response_code(204);
                }
            }
        }
        else {
            http_response_code(422);
        }
        break;
    case 'DELETE':
        if (empty(isset($_GET['id']))) {
            http_response_code(422);
        } else {
            $query_result = $con->query("SELECT * FROM users WHERE ID='" . $_GET['id'] . "'");
            $result = $query_result->fetch_row();
            if (!empty($result)) {
                $query_result = $con->query("DELETE FROM users WHERE ID='" . $_GET['id'] . "'");
                http_response_code(204);
            } else {
                http_response_code(204);
            }
        }
        break;
    default:
        http_response_code(405);
        break;
}
?>