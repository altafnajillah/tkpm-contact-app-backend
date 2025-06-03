<?php
// Ambil kontak berdasarkan ID pengguna

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

require_once '../../config/connect.php';

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "User ID is required"]);
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM contacts where user_id = $id ORDER BY name";
$result = mysqli_query($con, $sql);

if ($result) {
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($contacts);
} else {
    echo json_encode(["error" => "Gagal memuat kontak"]);
}
