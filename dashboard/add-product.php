<?php
    
    include "../libs/load.php";
    
    Session::start();
    $userAccount = Operations::getUserAccount();

    $error = "";
    
    if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit_title']) && isset($_POST['headline'])) {
                // Handle Headline submission
                $head = $_POST['headline'];
                $error = User::setHeadline($head);
            } elseif (isset($_POST['submit'])) {
                // Handle Product submission
                // echo "<pre>";
                // print_r($_POST);
                // print_r($_FILES);
                // echo "</pre>";
                // die();
                if (
                    !empty($_POST['proname']) &&
                    !empty($_POST['dec']) &&
                    !empty($_POST['status']) &&
                    !empty($_POST['category']) &&
                    !empty($_POST['procode']) &&
                    !empty($_FILES['images']['name'][0]) // Ensure at least one image is uploaded
                ) {
                    $proname = $_POST['proname'];
                    $proof = $_POST['proof'] ?? null;
                    $prodec = $_POST['dec'];
                    $table = $_POST['tab'] ?? null;
                    $images = $_FILES['images'];
                    $key = $_POST['status'];
                    $cate = $_POST['category'];
                    $procode = $_POST['procode'];
        
                    $error = User::setProducts($proname, $proof, $prodec, $table, $images, $key, $cate, $procode);
                } else {
                    $error = "Please fill all the required fields.";
                }
            }
        }
        
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    
    <?php include "temp/head.php"; ?>

    <body>
        <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
        <main class="main" id="top">
            <div class="container" data-layout="container">
                <?php include "temp/header.php"; ?>
                <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                    <div class="row g-0">
                        <div class="col-lg-8 pe-lg-2">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div class="card-header bg-body-tertiary">
                                            <h6 class="mb-0">Basic information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gx-2">
                                                <div class="col-12 mb-3"><label class="form-label" for="product-name">Product name:</label><input class="form-control" id="product-name" name="proname" type="text" required></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="offer-price">Price:</label><input class="form-control" id="offer-price" name="proof" type="number" value="0"></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="product-summary">Product Summary:</label><textarea class="form-control" id="dec" name="dec" cols="15" rows="13" required></textarea></div>
                                                <div class="col-12 mb-3"><label class="form-label" for="product-summary">Product Table - Use (== is Table Left and Right ,, is Next Row):</label><textarea class="form-control" id="tab" name="tab" cols="15" rows="8" required></textarea></div>
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

                                        <div class="card-body">
                                            <div id="dropzone" class="dropzone">
                                                Drag & Drop files here or click to browse
                                                <input type="file" id="fileInput" name="images[]" accept="image/*" multiple required hidden>
                                            </div>
                                            <div id="preview" class="preview-container mt-3"></div>
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
                                                    <select class="form-select" id="mainHeader" name="category" required>
                                                        <option>Select Category</option>
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
                                                        <option>Select Status</option>
                                                        <option value="Available">Available</option>
                                                        <option value="Sold-Out">Sold-Out</option>
                                                    </select>
                                                </div>
                                                <?php
                                                    function generateRandomCode($length = 8) {
                                                    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                                    $code = '';
                                                    for ($i = 0; $i < $length; $i++) {
                                                        $code .= $chars[rand(0, strlen($chars) - 1)];
                                                    }
                                                    return $code;
                                                    }
                                                ?>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="code">Product Code: </label>
                                                    <input id="code" name="procode" type="text" class="form-control" placeholder="Enter Product Code" value="<?= generateRandomCode(); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto" style="text-align: end;">
                                    <!-- <button class="btn btn-link text-secondary p-0 me-3 fw-medium" role="button">Discard</button> -->
                                    <button class="btn btn-primary" name="submit" role="button" type="submit">Add product</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 ps-lg-2">
                            <div class="sticky-sidebar top-0">
                                <div class="card mb-3">
                                    <div class="card-header bg-body-tertiary">
                                        <h6 class="mb-0">Title</h6>
                                    </div>
                                    <form action="add-product.php" method="post">
                                        <div class="card-body pt-0">
                                            <label class="form-label" for="product-tags">Add Names:</label>
                                            <input class="form-control js-choice" id="product-tags" type="text" name="headline" required>
                                            <button class="btn btn-sm btn-primary btn-falcon-default mt-2" name="submit_title" type="submit">Add</button>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                    $header = Operations::getHeadLine();
                                    if (!empty($header)) {
                                        foreach ($header as $head) { 
                                ?>
                                        <p><?= $head['header']; ?>
                                            <a href="delete-header.php?id=<?= $head['id']; ?>" style="color: red;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                                </svg>
                                            </a>
                                        </p>
                                <?php } } ?>
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
<?php
    } else {
        header("Location: 404.php");
    }
?>