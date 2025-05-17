<?php

class User
{
    public $conn = null;

    public static function register($name, $password, $email, $phone)
    {
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);
        $conn = Database::getConnection();

        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `created_at`) 
                VALUES ('$name', '$pass', '$email', '$phone', now());";
        try {
            if ($conn->query($sql)) {
                $avatar = "uploads/avatars/user.png";
                $userid = mysqli_insert_id($conn);
                $sql = "INSERT INTO `users` (`userid`, `avatar`, `location`, `uploaded_time`, `owner`, `user`)
                VALUES ('$userid', '$avatar', '', now(), '0', '$name');";
                try {
                    if ($conn->query($sql)) {
                        return "Account Created Please Login Your Account.";
                    } else {
                        throw new Exception("Error creating user profile: " . $conn->error);
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }
    }

    // Function for login
    public static function login($user, $pass)
    {
        Session::start();
        $conn = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$user' OR `email` = '$user' OR `phone` = '$user'";
        $result = $conn->query($query);
        if ($result && $result->num_rows === 1)
        {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password']))
            {
                Session::regenerate();
                Session::set("Loggedin", $user);
                header("Location: index.php");
                exit;
            }
            else
            {
                return "Invalid password!";
            }
        } elseif ($result && $result->num_rows > 1) {
            // Handle multiple rows case (unexpected behavior)
            return "Multiple accounts found. Please contact support.";
        } else {
            return "User not found!";
        }
    }

    public static function setUser($user, $email, $phone, $locat)
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $uid = $currentUser['id']; // Retrieve the user ID from the current session
        
        // Update the users table with new profile data
        $query = "UPDATE `users` SET `location` = '$locat', `user` = '$user' WHERE `userid` = '$uid'";
            
        try {
            if ($conn->query($query)) {
                $sql = "UPDATE `auth` SET `username` = '$user', `email` = '$email', `phone` = '$phone' WHERE `id` = '$uid'";
                    
                if ($conn->query($sql)) {
                    header("Location: profile.php");
                    return "Updated successfully!";
                } else {
                    return "Error updating user profile in 'auth' table: " . $conn->error;
                }
            } else {
                return "Error updating user profile in 'users' table: " . $conn->error;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function setNewPass($old, $new, $conf)
    {
        if ($new === $conf) {
            $db = Database::getConnection();
            $currentUser = Operations::getUser();
            $id = $currentUser['id']; // Retrieve the user ID from the current session
            $query = "SELECT `password` FROM `auth` WHERE `id` = '$id'";
            $result = $db->query($query);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($old, $row['password'])) {
                    $options = [
                        'cost' => 9,
                    ];
                    $password = password_hash($new, PASSWORD_BCRYPT, $options);
                    $update_profile = "UPDATE `auth` SET `password` = '$password' WHERE `id` = '$id'";
                    try {
                        if ($db->query($update_profile)) {
                            echo "<script>alert('Password has been changed.');</script>";
                            header("Location: profile.php");
                            return true;
                        } else {
                            throw new Exception('Password Update Error: ' . mysqli_error($db));
                            return false;
                        }
                    } catch (Exception $e) {
                        echo "<script>alert('Password Error: {$e->getMessage()}');</script>";
                        return false;
                    }
                } else {
                    return 'Verify Password Error.';
                }
            } else {
                return false;
            }
        } else {
            echo "<script>alert('Confirmation does not match the password.');</script>";
            return 'Confirmation does not match the password.';
        }
    }

    public static function setAvatar($avatar, $fileSize)
    {
        $conn = Database::getConnection();
        $currentUser = Operations::getUser();
        $userAccount = Operations::getUserAccount();
        $id = $currentUser['id'];

        // File upload directory
        if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin')
        {
            $targetDir = "uploads/avatars/";
        } else {
            $targetDir = "dashboard/uploads/avatars/";
        }

        // Create the directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create directory with proper permissions
        }

        // Check if a file is uploaded
        if (!empty($_FILES["avatar"]["name"])) {
            $fileName = basename($_FILES["avatar"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check file size (4MB max)
            if ($fileSize > 8 * 1024 * 1024) {
                $error = "File size should be below 8 MB.";
            } else {
                // Allowable file types
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                if (in_array($fileType, $allowTypes)) {
                    // Generate a unique file name to avoid overwriting existing files
                    $newFileName = uniqid('avatar_', true) . '.' . $fileType;
                    $targetFilePath = $targetDir . $newFileName;
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                        // Update the user's avatar in the database
                        $sql = "UPDATE `users` SET `avatar` = '$targetFilePath' WHERE `userid` = '$id'";

                        if ($conn->query($sql)) {
                            header("Location: profile.php");
                            return "The file has been uploaded and the avatar updated successfully.";
                        } else {
                            return "Database insertion failed: " . $conn->error;
                        }
                    } else {
                        return "Sorry, there was an error uploading your file.";
                    }
                } else {
                    return "Only JPG, JPEG, PNG, & GIF files are allowed.";
                }
            }
        } else {
            return "No file selected for upload.";
        }
    }

    public static function setHeadline($head)
    {
        $conn = Database::getConnection();
        $sql = "INSERT INTO `headline` (`header`, `created_at`) VALUES ('$head', NOW())";
        if ($conn->query($sql)) {
            return "Headline added successfully.";
        } else {
            return "Database insertion failed: " . $conn->error;
        }
    }

    public static function setProducts($proname, $proof, $prodec, $table, $images, $key, $cate, $procode)
    {
        $conn = Database::getConnection();
        $targetDir = "uploads/products/";
        
        // Ensure directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageNames = [];

        foreach ($images["name"] as $index => $name) {
            // Check for file upload errors
            if ($images["error"][$index] !== UPLOAD_ERR_OK) {
                return "Error uploading file: " . $name;
            }

            // Get the file extension
            $fileExt = pathinfo($name, PATHINFO_EXTENSION);

            // Generate a unique name with only extension
            $uniqueName = uniqid() . "." . $fileExt;
            $targetFilePath = $targetDir . $uniqueName;

            if (move_uploaded_file($images["tmp_name"][$index], $targetFilePath)) {
                $imageNames[] = $uniqueName;
            } else {
                return "Failed to move uploaded file: " . $name;
            }
        }

        if (!empty($imageNames)) {
            $imageList = implode(",", $imageNames);

            $sql = "INSERT INTO `products` (`name`, `of`, `dec`, `table`, `images`, `status`, `created_at`, `category`, `code`) 
                    VALUES ('$proname', '$proof', '$prodec', '$table', '$imageList', '$key', NOW(), '$cate', '$procode')";

            if ($conn->query($sql)) {
                header("Location: product-list.php");
                return "Product added successfully.";
            } else {
                return "Database insertion failed: " . $conn->error;
            }
        } else {
            return "Image upload failed.";
        }
    }

    public static function setOffer($title, $offer, $price, $sd, $ed)
    {
        $conn = Database::getConnection();

        // Insert into the database
        $sql = "INSERT INTO `offer` (`title`, `offer`, `price`, `sd`, `ed`, `created_at`) VALUES ('$title', '$offer', '$price', '$sd', '$ed', NOW())";

        if ($conn->query($sql)) {
            header("Location: list-offer.php");
            exit; // Stop further execution
        } else {
            return "Database insertion failed: " . $conn->error;
        }
    }
}

?>