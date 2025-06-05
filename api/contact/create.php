<?php
// Buat kontak baru

require "../../config/connect.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_POST['user_id'];

    if (empty($user_id)) {
        echo json_encode(["error" => "User ID is required"]);
        exit;
    }

    $response = array();

    $name = $_POST['name'] ?? NULL;
    $phone = $_POST['phone'] ?? NULL;
    $email = $_POST['email'] ?? NULL;
    $company = $_POST['company'] ?? NULL;
    $message = $_POST['message'] ?? NULL;

    $sql = "INSERT INTO contacts (id, user_id, name, email, phone, company, updated_at) 
    VALUES (NULL, '$user_id', '$name', '$email', '$phone', '$company', NOW())";

    if (mysqli_query($con, $sql)) {
        $response['message'] = "Contact created successfully";
    } else {
        $response['message'] = "Failed to create contact: " . mysqli_error($con);
    }

    echo json_encode($response);
}
