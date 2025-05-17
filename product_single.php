<?php

	include "libs/load.php";

    Session::start();

    // Get user and account details
    $user = Operations::getUser();
    $userAccount = Operations::getUserAccount();

    // Check if the user is logged in
    $isLoggedIn = Session::get('Loggedin');

	$product = Operations::getSingleProduct();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta
            name="description"
            content=""
        />
        <title>Product Details</title>
        
        <?php include "temp/head.php" ?>

        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid #ccc;
            }

            th, td {
                padding: 8px 12px;
                text-align: left;
            }

            thead th {
                background-color: #f5f5f5;
            }
        </style>

    </head>

    <body class="custom-cursor">
        <div class="custom-cursor__cursor"></div>
        <div class="custom-cursor__cursor-two"></div>

        <div class="preloader">
            <div class="preloader__image" style="background-image: url(assets/images/loader.png);"></div>
        </div>
        <!-- /.preloader -->
        <div class="page-wrapper">
            <?php include "temp/header.php" ?>

            <section class="page-header">
                <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);"></div>
                <!-- /.page-header__bg -->
                <div class="container">
                    <h2 class="page-header__title"><?= $product['category'] ?></h2>
                    <ul class="boskery-breadcrumb list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><span>products</span></li>
                        <li><span><?= $product['category'] ?></span></li>
                    </ul>
                    <!-- /.thm-breadcrumb list-unstyled -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.page-header -->

            <section class="product-details section-space">
                <div class="container">
                    <!-- /.product-details -->
                    <div class="row gutter-y-50">
                        <div class="col-lg-6 col-xl-6 wow fadeInLeft" data-wow-delay="200ms">
                            <div class="product-details__img">
                                <div class="swiper product-details__gallery-top">
                                    <div class="swiper-wrapper">
                                        <?php
                                            $images = explode(',', $product['images']);
                                            foreach ($images as $img) {
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="product-details__gallery-top__image">
                                                <img src="dashboard/uploads/products/<?= $img ?>" style="width: 570px;" alt="product details image" />
                                            </div>
                                            <!-- /.product-details__gallery-top__image -->
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="swiper product-details__gallery-thumb">
                                    <div class="swiper-wrapper">
                                        <?php
                                            $images = explode(',', $product['images']);
                                            foreach ($images as $img) {
                                        ?>
                                        <div class="product-details__gallery-thumb-slide swiper-slide">
                                            <img src="dashboard/uploads/products/<?= $img ?>" alt="product details thumb" />
                                        </div>
                                        <!-- /.product-details__gallery-thumb-slide -->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.column -->
                        <div class="col-lg-6 col-xl-6 wow fadeInRight" data-wow-delay="300ms">
                            <div class="product-details__content">
                                <div class="product-details__top">
                                    <div class="product-details__top__left">
                                        <h2 class="product-details__name"><?= $product['name'] ?></h2>
                                        <!-- /.product-title -->
                                        <h4 class="product-details__price">₹<?= $product['of'] ?></h4>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-details__price -->
                                </div>
                                <!-- /.review-ratings -->
                                <div class="product-details__excerpt">
                                    <p class="product-details__excerpt__text">
                                        <?= $product['dec'] ?>
                                    </p>
                                </div>
                                <!-- /.excerp-text -->
                                <div class="product-details__excerpt product-details__size">
                                    <table>
                                        <tbody>
                                            <?php
                                                $table = explode(',,', $product['table']);
                                                foreach ($table as $tab) {
                                            ?>
                                                <tr>
                                                    <?php
                                                        $datas = explode('==', $tab);
                                                        foreach ($datas as $data) {
                                                    ?>
                                                        <td><?= $data ?></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- /.product-details__size -->
                                <div class="product-details__info">
                                    <div class="product-details__quantity">
                                        <h3 class="product-details__content__title">Quantity</h3>
                                        <div class="quantity-box">
                                            <!-- MINUS (decrease) -->
                                            <button type="button" onclick="changeQty(false);" class="decrease sub">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <input type="number" name="quantity" value="1" min="1" id="input-quantity" />

                                            <!-- PLUS (increase) -->
                                            <button type="button" onclick="changeQty(true);" class="increase add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.quantity -->
                                    <div class="product-details__socials">
                                        <h3 class="product-details__socials__title">Product Status:</h3>
                                        <?php if ($product['status'] == 'Available') { ?>
                                        <p class="text-success m-0 p-0"><?= $product['status'] ?></p>
                                        <?php } else { ?>
                                            <p class="text-danger m-0 p-0"><?= $product['status'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <!-- /.product-details__socials -->
                                </div>
                                <!-- /.product-details__info -->
                                <div class="product-details__buttons">
                                    <button onclick="handleBuyNow(this);" class="product-details__btn boskery-btn"
                                            data-id="<?= $product['id']; ?>" 
                                            data-name="<?= $product['name']; ?>" 
                                            data-price="<?= $product['of'] ?>" 
                                            data-code="<?= $product['code']; ?>" 
                                            data-image="dashboard/uploads/products/<?= $images[0]; ?>">
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__text">Buy Now</span>
                                        <i class="icon-cart"></i>
                                    </button>
                                </div>
                                <!-- /.qty-btn -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-details -->
                </div>
            </section>
            <!-- /.product-details -->

            <?php include "temp/footer.php" ?>

    </body>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.map"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function changeQty(increase) {
            var qtyInput = document.getElementById("input-quantity");
            var qty = parseInt(qtyInput.value);

            if (!isNaN(qty)) {
                qty = increase ? qty + 1 : (qty > 1 ? qty - 1 : 1);
                qtyInput.value = qty;
            } else {
                qtyInput.value = 1;
            }
        }

        function handleBuyNow(button) {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name'); // Make sure you use `name` not `productName`
            const price = button.getAttribute('data-price');
            const code = button.getAttribute('data-code');
            const image = button.getAttribute('data-image');
            const quantity = document.getElementById('input-quantity')?.value || 1;

            // Show loading message before sending request
            Swal.fire({
                title: "Placing your order...",
                text: "Please wait while we submit your quote.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Show spinner
                }
            });

            const productDetails = {
                id: id,
                name: name,
                price: price,
                code: code,
                image: image,
                quantity: quantity
            };

            // console.log("Sending data:", productDetails);

            let isLoggedIn = <?= json_encode($isLoggedIn); ?>;
            if (!isLoggedIn) {
                window.location.href = "login.php";
                return;
            }
            
            let isLocation = <?= json_encode(!empty($userAccount['location'])); ?>;
            if (!isLocation) {
                alert("Please fulfill your profile Address");
                // If user is NOT logged in, redirect to login page
                window.location.href = "profile.php";
                return;
            }

            fetch("libs/Sender.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(productDetails)
            })
            .then(response => {
                // console.log("Response received:", response);  // Log the raw response
                return response.text();  // Get the response as text first
            })
            .then(responseText => {
                // console.log("Raw response text:", responseText);  // Log the raw text
                try {
                    const data = JSON.parse(responseText);  // Manually parse the JSON
                    // console.log("Parsed data:", data);  // Log the parsed JSON data
            
                    if (data.success) {
                        // console.log("Order placed successfully!");
                        Swal.fire({
                            icon: "success",
                            title: "Order Placed!",
                            html: `
                                <p>Your Code is <strong>${data.order_id}</strong>.</p>
                                <p>Your order was placed successfully from <strong>Sree Varsha Engineering Works</strong>.</p>
                                <button onclick="window.location.href='tel:9363126467'" class="contact-btn btn btn-outline-primary">
                                    📞 Call: 9363126467
                                </button>
                                <button onclick="window.open('https://wa.me/9791641548', '_blank')" class="whatsapp-btn btn btn-outline-success">
                                    ✅ WhatsApp
                                </button>
                            `,
                            confirmButtonText: "OK",
                        });
                    } else {
                        // console.log("Error in placing order:", data.message);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.message || "An unexpected error occurred."
                        });
                    }
                } catch (error) {
                    // console.error("Error parsing response as JSON:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An unexpected error occurred. Please try again later."
                    });
                }
            })
            .catch(error => {
                // console.error("Fetch error:", error);  // Log any error that occurs in the fetch process
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An unexpected error occurred. Please try again later."
                });
            });
        }
    </script>

</html>