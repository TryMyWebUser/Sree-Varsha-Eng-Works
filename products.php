<?php

	include "libs/load.php";

    Session::start();

    // Get user and account details
    $user = Operations::getUser();
    $userAccount = Operations::getUserAccount();

    // Check if the user is logged in
    $isLoggedIn = Session::get('Loggedin');

	$products = Operations::getProduct();

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
        <title>Products</title>
        
        <?php include "temp/head.php" ?>

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
                    <h2 class="page-header__title"><?= $_GET['data'] ?></h2>
                    <ul class="boskery-breadcrumb list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><span>products</span></li>
                    </ul>
                    <!-- /.thm-breadcrumb list-unstyled -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.page-header -->

            <section class="product-page section-space-bottom">
                <div class="container">
                    <div class="row justify-content-center gutter-y-30">
                        <div class="col-lg-12">
                            <div class="row gutter-y-30" data-masonry='{"percentPosition": true }'>
                                <?php
                                    if (!empty($products)) {
                                        foreach ($products as $pro) {
                                            $images = explode(',', $pro['images']);
                                ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="product__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                                        <div class="product__item__image">
                                            <?php foreach ($images as $i => $img) { if ($i == 0) { ?>
                                            <img src="dashboard/uploads/products/<?= $img ?>" alt="<?= $pro['name'] ?>" />
                                            <?php } } ?>
                                        </div>
                                        <!-- /.product-image -->
                                        <div class="product__item__content">
                                            <h4 class="product__item__title"><a href="product_single.php?id=<?= $pro['id'] ?>"><?= $pro['name'] ?></a></h4>
                                            <!-- /.product-title -->
                                            <div class="product__item__price">₹<?= $pro['of'] ?></div>
                                            <!-- /.product-price -->
                                            <button class="boskery-btn product__item__link add-to-cart" 
                                                    data-id="<?= $pro['id']; ?>" 
                                                    data-name="<?= $pro['name']; ?>" 
                                                    data-price="<?= $pro['of'] ?>" 
                                                    data-code="<?= $pro['code']; ?>" 
                                                    data-image="dashboard/uploads/products/<?= $images[0]; ?>">
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__text">Add to Cart</span>
                                                <i class="icon-cart"></i>
                                            </button>
                                        </div>
                                        <!-- /.product-content -->
                                    </div>
                                    <!-- /.product-item -->
                                </div>
                                <!-- /.col-md-6 col-lg-4 -->
                                <?php } } else { echo "<p>Product Not Found!</p>"; } ?>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col-lg-9 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.product-page section-space-bottom -->

            <?php include "temp/footer.php" ?>

    </body>

    <script>
        let cart = [];

        function addToCart(event)
        {
            event.preventDefault();

            let button = event.target.closest('.add-to-cart');

            let productId = button.getAttribute("data-id");
            let productName = button.getAttribute("data-name");
            let productPrice = parseFloat(button.getAttribute("data-price"));
            let productCode = button.getAttribute("data-code");
            let productImage = button.getAttribute("data-image");

            // Check if product already exists in the cart
            let existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    code: productCode,
                    image: productImage,
                    quantity: 1
                });
            }
            
            updateCartUI();
        }

        function updateCartUI() {
            let cartContent = document.querySelector(".cart-content");
            cartContent.innerHTML = "";

            if (cart.length === 0) {
                cartContent.innerHTML = `
                    <p style="text-align: center; color: red; font-weight: bold; padding: 20px;">Your cart is empty.</p>
                `;
                return;
            }

            cart.forEach(product => {
                let priceDisplay = product.price > 0 ? `<p style="color: #790004; justify-self: center;">₹${product.price}</p>` : "";

                let cartItem = `
                    <div class="cart-item d-flex align-items-center flex-column">
                        <img src="${product.image}" style="width: 6rem;" class="rounded border" alt="${product.name}">
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold">${product.name}</p>
                            ${priceDisplay}
                        </div>
                        <div class="quantity-controls d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity('${product.id}')">−</button>
                            <span class="mx-2 quantity">${product.quantity}</span>
                            <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity('${product.id}')">+</button>
                        </div>
                    </div>
                `;
                cartContent.innerHTML += cartItem;
            });

            document.getElementById("cartDrawer").classList.add("active");
        }

        function increaseQuantity(productId) {
            let product = cart.find(item => item.id === productId);
            if (product) {
                product.quantity++;
                updateCartUI();
            }
        }

        function decreaseQuantity(productId) {
            let product = cart.find(item => item.id === productId);
            if (product && product.quantity > 1) {
                product.quantity--;
            } else {
                cart = cart.filter(item => item.id !== productId);
            }
            updateCartUI();
        }

        // Event listener for all "Add to Cart" buttons
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".add-to-cart").forEach(button => {
                button.addEventListener("click", addToCart);
            });

            updateCartUI(); // Ensure cart is checked on page load
        });
    </script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.map"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function handleGetQuote() {
            let isLoggedIn = <?php echo json_encode($isLoggedIn); ?>; // Check login status from PHP
            
            if (!isLoggedIn) {
                // If user is NOT logged in, redirect to login page
                window.location.href = "login.php";
                return;
            }
            
            let isLocation = <?php echo json_encode(!empty($userAccount['location'])); ?>;
            
            if (!isLocation) {
                alert("Please fulfill your profile Address");
                // If user is NOT logged in, redirect to login page
                window.location.href = "profile.php";
                return;
            }

            // If user is logged in, proceed with sending cart data
            sendQuoteRequest();
        }

        function sendQuoteRequest() {
            // Show loading message before sending request
            Swal.fire({
                title: "Placing your order...",
                text: "Please wait while we submit your quote.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Show spinner
                }
            });

            const cartData = JSON.stringify(cart);

            fetch("libs/Send.class.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ cart })  // No double stringify
            })
            .then(response => response.text())
            .then(text => {
                // console.log("Raw response:", text);
                return JSON.parse(text);
            })
            .then(data => {
                Swal.close(); // Hide the loading popup

                if (data.success) {
                    document.getElementById("cartDrawer").classList.remove("active");
                    showSuccessMessage(data.order_id);
                } else {
                    showErrorMessage(data.message);
                }
            })
            .catch(error => {
                Swal.close(); // Hide loading on error too
                showErrorMessage("An unexpected error occurred. Please try again later.");
            });
        }
        
        // Function to show success message
        function showSuccessMessage(orderId) {
            Swal.fire({
                icon: "success",
                title: "Order Placed!",
                html: `
                    <p>Your Code is <strong>${orderId}</strong>.</p>
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
        }
        
        // Function to show error message
        function showErrorMessage(message) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: message
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

</html>