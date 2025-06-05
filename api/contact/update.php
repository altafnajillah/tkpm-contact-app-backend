<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS");

require_once '../../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == "PUT") {

    $id = $_GET['id'];
    if (!$id) {
        echo json_encode(["error" => "Contact ID is required"]);
        exit;
    }

    // Ambil data dari body PUT (format x-www-form-urlencoded)
    parse_str(file_get_contents("php://input"), $_PUT);

    $response = array();
    $name = $_PUT['name'];
    $phone = $_PUT['phone'];
    $email = $_PUT['email'];
    $company = $_PUT['company'];
    $message = $_PUT['message'];

    $sql = "UPDATE contacts SET 
            name = '$name', 
            phone = '$phone', 
            email = '$email', 
            company = '$company', 
            updated_at = NOW() 
            WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        $response['message'] = "Contact updated successfully";
    } else {
        $response['error'] = "Failed to update contact: " . mysqli_error($con);
    }

    echo json_encode($response);
}
