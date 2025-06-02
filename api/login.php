<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

require "../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $cek = "SELECT * FROM users WHERE username='$username'";
    $query = mysqli_query($con, $cek);
    $result = mysqli_fetch_array($query);

    if ($result && password_verify($password, $result['password'])) {
        $response['flag'] = 1;
        $response['message'] = "Login berhasil";
        echo json_encode($response);
    } else {
        $response['flag'] = 0;
        $response['message'] = "Login gagal";
        echo json_encode($response);
    }
}
