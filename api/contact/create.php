<?php
// Buat kontak baru

require "../../config/connect.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_GET['id'];

    $response = array();

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (id, user_id, name, email, phone, company, updated_at) VALUES (NULL, '$user_id', '$name', '$email', '$phone', '$company', NOW())";

    if (mysqli_query($con, $sql)) {
        $response['message'] = "Contact created successfully";
    } else {
        $response['message'] = "Failed to create contact: " . mysqli_error($con);
    }

    echo json_encode($response);
}
