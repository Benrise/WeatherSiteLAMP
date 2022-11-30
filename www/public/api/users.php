<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
header('Content-Type: application/json');
$con = new mysqli("MYSQL", "user", "password", "appDB");
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
        if (!empty($user->{'username'}) && !empty($user->{'password'}) && !empty($user->{'email'})) {
            $username = $user->{'username'};
            $password = $user->{'password'};
            $email = $user->{'email'};
            $query_result = $con->query("SELECT * FROM users WHERE username='" . $username . "'");
            if (!empty($result)) {
                http_response_code(409);
            } else {
                $password = crypt($password);
                $stmt = $con->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->bind_param('sss', $username, $password, $email);
                $stmt->execute();
                http_response_code(201);
            }
        } else {
            http_response_code(422);
        }

        break;
    case 'PUT':
        $json = file_get_contents('php://input');
        $user = json_decode($json);
        if (!empty($user->{'username'}) && !empty($user->{'email'})) {
            if (empty(isset($_GET['id']))) {
                http_response_code(422);
            } else {
                $query_result = $con->query("SELECT * FROM users WHERE ID='" . $_GET['id'] . "'");
                $result = $query_result->fetch_row();
                if (!empty($result)) {
                    $query_result = $con->query("SELECT * FROM users WHERE username='" . $user->{'username'} . "' AND ID!='" . $_GET['id'] . "'");
                    $result = $query_result->fetch_row();
                    if (!empty($result)) {
                        http_response_code(409);
                    } else {
                        $con->query("UPDATE users SET username='" . $user->{'username'} . "', email='" . $user->{'email'} . "' WHERE ID='" . $_GET['id'] . "'");
                        http_response_code(200);
                    }
                } else {
                    http_response_code(204);
                }
            }
        } else {
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