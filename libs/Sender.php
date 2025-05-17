<?php
require_once "load.php";
require_once __DIR__ . '/vendor/autoload.php';
require "Mailer.class.php";

Session::start();

// Check if the user is logged in
if (!Session::get('Loggedin')) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit();
}

// Get JSON data from request
$cart = json_decode(file_get_contents('php://input'), true);

if (!$cart) {
    echo json_encode(["success" => false, "message" => "Invalid JSON data received"]);
    exit();
}

$productName = $cart['name'];
$productCode = $cart['code'];
$productQuantity = (int) $cart['quantity'];

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
$emailService = new Mailer();

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

$createdAt = date("Y-m-d H:i:s");

// Insert into cart
$sql = "INSERT INTO `cart` (`name`, `email`, `phone`, `location`, `proname`, `quantity`, `order_code`, `created_at`) 
        VALUES ('$userName', '$userEmail', '$userPhone', '$userLocation', '$productName', '$productQuantity', '$productCode', '$createdAt')";

$insertSuccess = false;
if ($conn->query($sql)) {
    $insertSuccess = true;
}
$conn->close();

$emailResult = $emailService->sendQuoteEmail($userEmail, $userName, $userPhone, [$cart], $productCode);

if ($insertSuccess && $emailResult["success"]) {
    echo json_encode([
        "success" => true,
        "message" => "Your order was placed successfully.",
        "order_id" => $productCode
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $emailResult["message"] ?? "Failed to place order.",
        "email_status" => $emailResult["success"] ?? false
    ]);
}

?>