<?php
// Ambil data kontak berdasarkan ID

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

require "../../config/connect.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (!isset($_GET['id'])) {
        echo json_encode(["error" => "User ID is required"]);
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $contact = mysqli_fetch_assoc($result);
        if ($contact) {
            echo json_encode($contact);
        } else {
            echo json_encode(["error" => "Contact not found"]);
        }
    }
    else {
        echo json_encode(["error" => "Failed to load contact"]);
    }
}
