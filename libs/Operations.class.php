<?php

class Operations
{
    public static function getUser()
    {
        $conn = Database::getConnection();
        $user = Session::get('Loggedin');
        $sql = "SELECT * FROM `auth` WHERE `email` = '$user' OR `username` = '$user' OR `phone` = '$user'"; // Fetch only the most recent user
        $result = $conn->query($sql);

        // Check if the query returned any result
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Get the first row as an associative array
            return $user;
        }

        return null; // Return null if no user is found
    }

    public static function getUserAccount()
    {
        $conn = Database::getConnection();
        $loguser = Session::get('Loggedin');
        $sql = "SELECT * FROM `users` WHERE `user` = '$loguser'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function getuserProfile()
    {
        $username = $_GET['username'];
        $db = Database::getConnection();
        $sql = "SELECT * FROM `users` WHERE `owner`='$username'";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public static function getUserCount()
    {
        $conn = Database::getConnection(); // Assuming this returns a MySQLi connection
        $sql = "SELECT COUNT(*) AS `user_count` FROM `auth`";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['user_count'];
    }

    public static function getAllProfiles()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `users`";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getHeadLine()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `headline`";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getProducts()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `products`";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getCart()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `cart`";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getSingleProduct()
    {
        $id = $_GET['id'];
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `products` WHERE `id` = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public static function getProduct()
    {
        $product = $_GET['data'];
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `products` WHERE `category` = '$product'";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getOffer()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `offer`";
        $result = $conn->query($sql);
        return iterator_to_array($result);
    }

    public static function getOfferlist($title) {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM `products` WHERE `name` = '$title'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
}

?>