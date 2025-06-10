<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    if (!isset($_GET['id'])) {
        echo json_encode(["error" => "Contact ID is required"]);
        exit;
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM contacts WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(["message" => "Contact deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete contact: " . mysqli_error($con)]);
    }
}