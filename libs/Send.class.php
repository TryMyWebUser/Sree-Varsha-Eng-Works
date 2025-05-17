<?php

include "load.php";
require_once __DIR__ . '/vendor/autoload.php';
require "Mailer.class.php";

Session::start();

// Check if user is logged in
if (!Session::get('Loggedin')) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit();
}

// Read and decode the incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);
$cart = $data['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Cart is empty"]);
    exit();
}

$user = Operations::getUser();
$userAccount = Operations::getUserAccount();

if (!$user && !$userAccount) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit();
}

$userName = $user['username'] ?? "Guest";
$userEmail = $user['email'] ?? null;
$userPhone = $user['phone'] ?? "Not provided";
$userLocation = $userAccount['location'];

if (!$userEmail) {
    echo json_encode(["success" => false, "message" => "User email is missing"]);
    exit();
}

// Database connection
$conn = Database::getConnection();

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

// $orderID = strtoupper(uniqid("ODWXVJD"));
$createdAt = date("Y-m-d H:i:s");

$orderID = null;

// Insert each product in the cart into the DB
foreach ($cart as $item) {
    $productName = $conn->real_escape_string($item['name']);
    $quantity = intval($item['quantity']);
    $orderCode = $conn->real_escape_string($item['code']);

    if ($orderID === null) {
        $orderID = $orderCode;
    }

    $sql = "INSERT INTO `cart` (`name`, `email`, `phone`, `location`, `proname`, `quantity`, `order_code`, `created_at`) 
            VALUES ('$userName', '$userEmail', '$userPhone', '$userLocation', '$productName', $quantity, '$orderCode', '$createdAt')";

    if (!$conn->query($sql)) {
        echo json_encode(["success" => false, "message" => "Failed to save order"]);
        exit();
    }
}

$conn->close();

// Correct arguments passed to sendQuoteEmail
$emailService = new Mailer();
$emailResult = $emailService->sendQuoteEmail($userEmail, $userName, $userPhone, $cart, $orderID);

// Return the result to frontend
if ($emailResult["success"]) {
    echo json_encode([
        "success" => true,
        "message" => "Your order was placed successfully.",
        "order_id" => $orderID
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "There was an issue sending your email. Please try again later.",
        "email_status" => false
    ]);
}

?>