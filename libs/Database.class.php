<?php

class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null)
        {
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "varsha";
            // $server = "localhost";
            // $username = "trymywebsites_varsha";
            // $password = "varsha@2025";
            // $dbname = "trymywebsites_varshadb";

            $connection = new mysqli($server, $username, $password, $dbname);

            if ($connection->connect_error)
            {
                die("Connection Failed: " . $connection->connect_error);
            }
            else
            {
                Database::$conn = $connection;
                return Database::$conn;
            }
        }
        return Database::$conn; // Return the connection here.
    }
}

?>