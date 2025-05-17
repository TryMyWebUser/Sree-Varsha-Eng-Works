<?php

include "../libs/load.php";

if (isset($_GET['id'])) {
    $conn = Database::getConnection();
    $delete_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Delete the product from the database
    $sql = "DELETE FROM `cart` WHERE `id` = '$delete_id'";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: index.php");
    } else {
        die("Failed to delete product");
    }

} else {
    die("No ID provided");
}

?>