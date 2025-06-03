<?php
// Ambil data user berdasarkan ID 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

require "../../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cek = "SELECT id, name, username FROM users WHERE id='$id'";
        $query = mysqli_query($con, $cek);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            $response['message'] = "Data user ditemukan";
            $response['data'] = $result;
        } else {
            $response['message'] = "User tidak ditemukan";
        }
    } else {
        $response['message'] = "ID user tidak diberikan";
    }

    echo json_encode($response);
}