<?php

include "../libs/load.php";

if (isset($_GET['id'])) {
    $conn = Database::getConnection();
    $delete_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Fetch the product details
    $products = Operations::getSingleProduct();

    if ($products) {
        $images = explode(',', $products['images']); // Convert images string to array

        // Delete images from the server
        foreach ($images as $image) {
            $imagePath = trim($image); // Remove spaces, if any
            $final = "uploads/products/" . $imagePath;
            if (!empty($final)) {
                unlink($final);
            }
        }

        // Delete the product from the database
        $sql = "DELETE FROM `products` WHERE `id` = '$delete_id'";
        $result = $conn->query($sql);

        if ($result) {
            header("Location: product-list.php");
        } else {
            die("Failed to delete product");
        }
    } else {
        die("Product not found");
    }
} else {
    die("No ID provided");
}

?>