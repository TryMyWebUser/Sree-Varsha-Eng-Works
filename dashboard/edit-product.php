<?php

    include "../libs/load.php";

    Session::start();

    $userAccount = Operations::getUserAccount();
    $product = Operations::getSingleProduct();

    $error = "";

    if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {
        if ($_GET['id'] ?? null) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_GET['id'];
                $targetDir = "uploads/products/";

                // Handle image deletion
                if (isset($_POST['delete_submit']) && isset($_POST['delete_images']) && !empty($_POST['delete_images'])) {
                    $imagesToDelete = $_POST['delete_images'];
                    $existingImages = explode(",", $product["images"]);

                    foreach ($imagesToDelete as $index) {
                        if (isset($existingImages[$index])) {
                            $imageToDelete = $existingImages[$index];
                            if (file_exists($targetDir . $imageToDelete)) {
                                unlink($targetDir . $imageToDelete); // Delete the image
                                echo "Deleted: $imageToDelete<br>"; // Debugging line
                            }
                            unset($existingImages[$index]); // Remove from the array
                        }
                    }

                    $existingImages = array_values($existingImages); // Re-index the array
                    $updatedImages = implode(",", $existingImages); // Updated image list

                    $sql = "UPDATE `products` SET `images` = '$updatedImages' WHERE `id` = '$id'";
                    $conn = Database::getConnection();
                    if (!$conn->query($sql)) {
                        $error = "Failed to update the database: " . $conn->error;
                    } else {
                        error_reporting(0);  // Turn off error reporting temporarily
                        header("Location: product-list.php");
                        exit;
                    }
                }

                // Handle form submission for updating product details and images
                if (isset($_POST['submit'])) {
                    // echo "<pre>";
                    // print_r($_POST);
                    // print_r($_FILES);
                    // echo "</pre>";
                    // exit;
                    // die();
                    $proname = $_POST['proname'];
                    $proof = $_POST['proof'];
                    $prodec = $_POST['dec'];
                    $table = $_POST['tab'];
                    $status = $_POST['status'];
                    $imageIndex = $_POST['index'] ?? null; // Image index for replacement
                    $newImage = $_FILES['newimg'];
                    $cate = $_POST['category'];
                    $procode = $_POST['procode'];

                    $conn = Database::getConnection();
                    $updatedImages = $product['images']; // Default to existing images

                    // Check if new image is uploaded
                    if (isset($_FILES['newimg']) && !empty($_FILES['newimg']['name'][0])) {
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }

                        $uploadedImages = [];

                        foreach ($_FILES['newimg']['name'] as $key => $name) {
                            if ($_FILES['newimg']['error'][$key] === UPLOAD_ERR_OK) {
                                $fileExt = pathinfo($name, PATHINFO_EXTENSION);
                                $uniqueName = uniqid() . "." . $fileExt;
                                $targetFilePath = $targetDir . $uniqueName;

                                if (move_uploaded_file($_FILES['newimg']['tmp_name'][$key], $targetFilePath)) {
                                    $uploadedImages[] = $uniqueName; // Store uploaded image names
                                }
                            }
                        }

                        // If images are uploaded, handle replacement or appending
                        if (!empty($uploadedImages)) {
                            $existingImages = explode(",", $product["images"]);

                            // Replace selected image (if image index is provided)
                            if ($imageIndex !== null && isset($existingImages[$imageIndex])) {
                                $previousImage = $existingImages[$imageIndex];
                                if (file_exists($targetDir . $previousImage)) {
                                    unlink($targetDir . $previousImage); // Delete the old image
                                    echo "Deleted: $previousImage<br>"; // Debugging line
                                }

                                // Replace the image
                                echo "Replacing with: " . $uploadedImages[0] . "<br>"; // Debugging line
                                $existingImages[$imageIndex] = $uploadedImages[0];
                            } else {
                                // No index selected, append new images
                                echo "Appending new images.<br>"; // Debugging line
                                $existingImages = array_merge($existingImages, $uploadedImages);
                            }

                            $updatedImages = implode(",", $existingImages); // Updated image string
                        }
                    }

                    // Update the database with new details and images (if uploaded)
                    $sql = "UPDATE `products` 
                            SET `name` = '$proname',
                                `of` = '$proof', 
                                `dec` = '$prodec', 
                                `images` = '$updatedImages', 
                                `table` = '$table', 
                                `status` = '$status', 
                                `created_at` = NOW(),
                                `category` = '$cate',
                                `code` = '$procode'
                            WHERE `id` = '$id'";
                    if ($conn->query($sql)) {
                        error_reporting(0);  // Turn off error reporting temporarily
                        header("Location: product-list.php");
                        exit;
                    } else {
                        $error = "Database update failed: " . $conn->error;
                    }
                }
            }
        } else {
            header("Location: 404.php");
        }
    } else {
        header("Location: 404.php");
    }

?>



<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    
    <?php include "temp/head.php"; ?>

    <body>
        <main class="main" id="top">
            <div class="container" data-layout="container">
                <?php include "temp/header.php"; ?>
                <p><?= $error ?></p>
                    <div class="row g-0">
                        <div class="col-lg-8 pe-lg-2">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div class="card-header bg-body-tertiary">
                                            <h6 class="mb-0">Basic information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gx-2">
                                                <div class="col-12 mb-3"><label class="form-label" for="product-name">Product name:</label><input class="form-control" id="product-name" name="proname" type="text" value="<?= $product['name'] ?>"></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="offer-price">Offer Price:</label><input class="form-control" id="offer-price" name="proof" type="number" value="<?= $product['of'] ?>"></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="product-summary">Product Summary:</label><textarea class="form-control" id="dec" name="dec" cols="15" rows="13"><?= $product['dec'] ?></textarea></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="product-summary">Product Table - Use (== is Table Left and Right ,, is Next Row):</label><textarea class="form-control" id="tab" name="tab" cols="15" rows="8" required><?= $product['table'] ?></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-header bg-body-tertiary">
                                            <h6 class="mb-0">Add images</h6>
                                        </div>
                                        <style>
                                            .dropzone {
                                                border: 2px dashed #007bff;
                                                border-radius: 5px;
                                                padding: 20px;
                                                text-align: center;
                                                cursor: pointer;
                                            }
                                            .dropzone.dragover {
                                                background-color: #f8f9fa;
                                            }
                                            .preview-container {
                                                display: flex;
                                                flex-wrap: wrap;
                                                gap: 10px;
                                            }
                                            .preview-item {
                                                position: relative;
                                                display: inline-block;
                                            }
                                            .preview-item img {
                                                max-width: 100px;
                                                border-radius: 5px;
                                            }
                                            .remove-btn {
                                                position: absolute;
                                                top: 0;
                                                right: 0;
                                                background: red;
                                                color: white;
                                                border: none;
                                                border-radius: 50%;
                                                width: 20px;
                                                height: 20px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-size: 12px;
                                                cursor: pointer;
                                            }

                                            .hidden { display: none; }
                                        </style>

                                        <!-- Image Section -->
                                        <div class="card-body">
                                            <div id="dropzone" class="dropzone">
                                                Drag & Drop files here or click to browse
                                                <input type="file" id="fileInput" name="newimg[]" accept="image/*" multiple hidden>
                                            </div>
                                            <div id="preview" class="preview-container mt-3"></div>
                                            <p class="m-0">Select Updating Image</p>
                                            <div class="preview-container">
                                                <?php $images = explode(',', $product['images']); foreach ($images as $index => $image) { ?>
                                                <div class="preview-item d-flex align-items-center justify-content-center">
                                                    <input type="checkbox" class="position-absolute" name="delete_images[]" value="<?= $index; ?>">
                                                    <img src="uploads/products/<?= $image ?>" class="img-thumbnail" alt="Image Not Found">
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <!-- Delete Selected Images Button -->
                                            <button type="submit" id="deleteSelected" class="btn btn-danger mt-3" style="display: none;" name="delete_submit">Delete Selected Images</button>
                                        </div>
                                

                                        <script>
                                            const dropzone = document.getElementById("dropzone");
                                            const fileInput = document.getElementById("fileInput");
                                            const preview = document.getElementById("preview");

                                            dropzone.addEventListener("click", () => fileInput.click());

                                            dropzone.addEventListener("dragover", (e) => {
                                                e.preventDefault();
                                                dropzone.classList.add("dragover");
                                            });

                                            dropzone.addEventListener("dragleave", () => dropzone.classList.remove("dragover"));

                                            dropzone.addEventListener("drop", (e) => {
                                                e.preventDefault();
                                                dropzone.classList.remove("dragover");
                                                handleFiles(e.dataTransfer.files);
                                            });

                                            fileInput.addEventListener("change", () => handleFiles(fileInput.files));

                                            function handleFiles(files) {
                                                [...files].forEach(file => {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        const previewItem = document.createElement("div");
                                                        previewItem.classList.add("preview-item");

                                                        const img = document.createElement("img");
                                                        img.src = e.target.result;
                                                        img.classList.add("img-thumbnail");

                                                        const removeBtn = document.createElement("button");
                                                        removeBtn.innerHTML = "&times;";
                                                        removeBtn.classList.add("remove-btn");
                                                        removeBtn.onclick = () => previewItem.remove();

                                                        previewItem.appendChild(img);
                                                        previewItem.appendChild(removeBtn);
                                                        preview.appendChild(previewItem);
                                                    };
                                                    reader.readAsDataURL(file);
                                                });
                                            }

                                            // Show/hide the "Delete Selected Images" button based on checkbox selection
                                            const checkboxes = document.querySelectorAll('input[name="delete_images[]"]');
                                            const deleteButton = document.getElementById('deleteSelected');

                                            checkboxes.forEach(checkbox => {
                                                checkbox.addEventListener('change', () => {
                                                    const checkedBoxes = document.querySelectorAll('input[name="delete_images[]"]:checked');
                                                    deleteButton.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-header bg-body-tertiary">
                                            <h6 class="mb-0">Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gx-2">
                                                <div class="col-sm-6 mb-3">
                                                    <label class="form-label" for="mainHeader">Select Category: </label>
                                                    <select class="form-select" id="mainHeader" name="category">
                                                        <option value="<?= $product['category']; ?>"><?= $product['category']; ?></option>
                                                        <?php
                                                            $headline = Operations::getHeadLine();
                                                            foreach ($headline as $head) {
                                                        ?>
                                                        <option value="<?= $head['header']; ?>"><?= $head['header']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <label class="form-label" for="key-features">Product Status: </label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option value="<?= $product['status']; ?>" selected><?= $product['status']; ?></option>
                                                        <option value="Available">Available</option>
                                                        <option value="Sold-Out">Sold-Out</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="code">Product Code: </label>
                                                    <input id="code" name="procode" type="text" class="form-control" placeholder="Enter Product Code" value="<?= $product['code']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto" style="text-align: end;">
                                    <!-- <button class="btn btn-link text-secondary p-0 me-3 fw-medium" role="button">Discard</button> -->
                                    <button class="btn btn-primary" name="submit" role="button" type="submit">Update product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php include "temp/footer.php"; ?>
    </body>
    <script>
        // Get elements
        const mainDropdown = document.getElementById("mainHeader");
        const allDropdowns = document.querySelectorAll(".hidden"); // All hidden dropdowns

        mainDropdown.addEventListener("change", function() {
            // Hide all secondary dropdowns first
            allDropdowns.forEach(dropdown => dropdown.classList.add("hidden"));

            // Get selected value from main dropdown
            const selectedValue = mainDropdown.value;

            // Check if the selected value has a corresponding dropdown
            if (selectedValue) {
                const targetDropdown = document.getElementById(selectedValue); // Get corresponding ID
                if (targetDropdown) {
                    targetDropdown.classList.remove("hidden"); // Show the matching dropdown
                }
            }
        });

        document.querySelector("form").addEventListener("submit", function (event) {
            let category = document.getElementById("category");
            if (!category.value) {
                alert("Please select a category!");
                event.preventDefault(); // Prevent form submission
            }
        });

    </script>

</html>