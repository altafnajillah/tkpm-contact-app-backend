<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require_once '../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $id = $_GET['id'];

    $response = array();

    if (empty($id)) {
        $response['error'] = "User ID is required";
        echo json_encode($response);
        exit;
    }

    parse_str(file_get_contents("php://input"), $data);
    $username = $data['username'];
    $password = $data['password'];
    $confirm_password = $data['confirm_password'];
    $name = $data['name'];
    
    if (empty($username) || empty($password) || empty($name)) {
        echo json_encode(["error" => "Username, password, and name are required"]);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(["error" => "Passwords do not match"]);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET
            username = '$username',
            password = '$hashed_password',
            name = '$name'
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        $response['message'] = "User updated successfully";
    } else {
        $response['error'] = "Failed to update user: " . mysqli_error($con);
    }
    echo json_encode($response);
}
