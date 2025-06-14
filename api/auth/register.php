<?php
// Create a new user account

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require "../../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $response = array();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $cek = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        $response['flag'] = 2;
        $response['message'] = "Username sudah tersedia";
        echo json_encode($response); 
    } else {
        $sql = "INSERT INTO users VALUE(NULL, '$username', '$hashed_password', '$name', '1', NOW())";
        $insert = mysqli_query($con, $sql);
        if ($insert) {
            $response['flag'] = 1;
            $response['message'] = "Berhasil didaftarkan";
            echo json_encode($response); 
        } else {
            $response['flag'] = 0;
            $response['message'] = "Gagal didaftarkan";
            echo json_encode($response);
        }
    }
}
?>