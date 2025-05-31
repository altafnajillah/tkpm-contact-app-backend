<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

require "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $username = $_POST['username'];
    $password = $_POST['password'];


    $cek = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        $response['flag'] = 1;
        $response['message'] = "Login berhasil";
        echo json_encode($response);
    } else {
        $response['flag'] = 0;
        $response['message'] = "Login gagal";
        echo json_encode($response);
    }
}
