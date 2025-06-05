<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require "../../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cek = "SELECT id, name, username FROM users WHERE id='$id'";
        $query = mysqli_query($con, $cek);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            $delete = "DELETE FROM users WHERE id='$id'";
            if (mysqli_query($con, $delete)) {
                $response['message'] = "User berhasil dihapus";
            } else {
                $response['message'] = "Gagal menghapus user: " . mysqli_error($con);
            }
        } else {
            $response['message'] = "User tidak ditemukan";
        }
    } else {
        $response['message'] = "ID tidak diberikan";
    }

    echo json_encode($response);
}

?>