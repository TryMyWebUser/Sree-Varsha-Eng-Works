<?php

	include "libs/load.php";

    Session::start();

    // Get user and account details
    $user = Operations::getUser();
    $userAccount = Operations::getUserAccount();

    // Check if the user is logged in
    $isLoggedIn = Session::get('Loggedin');

	$offset = Operations::getOffer();

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
        <title>Sree Varsha Engineering Works</title>
        
        <?php include "temp/head.php" ?>

        <!-- Styles -->
        <style>
            .cart-drawer {
                position: fixed;
                right: -300px;
                top: 0;
                width: 300px;
                height: 100%;
                background: white;
                border-left: 1px solid #ccc;
                transition: right 0.3s ease;
                z-index: 1000;
                padding: 20px;
            }

            .cart-drawer.open {
                right: 0;
            }

            .cart-item {
                border-bottom: 1px solid #eee;
                padding: 10px 0;
            }

            .quantity-controls {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .close-cart {
                background: transparent;
                border: none;
                font-size: 20px;
                float: right;
                cursor: pointer;
            }

            #cart-button {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1100;
                background: #007bff;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 50%;
                cursor: pointer;
            }

            #cart-button span {
                background: red;
                color: white;
                font-size: 12px;
                padding: 2px 6px;
                border-radius: 50%;
                margin-left: 5px;
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

            <section class="hero-slider-one hero-main-slider" id="home">
                <div
                    class="hero-slider-one__carousel boskery-owl__carousel--with-counter owl-carousel"
                    data-owl-options='{
                        "loop": true,
                        "animateIn": "fadeIn",
                        "animateOut": "slideOutDown",
                        "items": 1,
                        "autoplay": true,
                        "autoplayTimeout": 7000,
                        "smartSpeed": 1000,
                        "nav": false,
                        "navText": ["<span class=\"icon-left-arrow\"></span>","<span class=\"icon-right-arrow\"></span>"],
                        "dots": true,
                        "margin": 0
                        }'>
                    <div class="item">
                        <div class="hero-slider-one__item">
                            <div class="hero-slider-one__bg" style="background-image: url(assets/images/backgrounds/slider-1-1.jpg);"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-10 col-lg-10">
                                        <div class="hero-slider-one__content">
                                            <h5 class="hero-slider-one__sub-title">Welcome To</h5>
                                            <!-- /.slider-sub-title -->
                                            <h2 class="hero-slider-one__title">
                                                Sree Varsha <br>Engineering Works
                                                <span class="hero-slider-one__title__overlay-group">
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                </span>
                                            </h2>
                                            <h5 class="hero-slider-one__sub-title">UPVC Window & Door Hardware</h5>
                                            <!-- /.slider-title -->
                                            <div class="hero-slider-one__btn">
                                                <a href="https://wa.me/+919047039929" class="boskery-btn">
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__text">For Enquiry</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                                <!-- slider-btn -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.slider-item -->
                    <div class="item">
                        <div class="hero-slider-one__item">
                            <div class="hero-slider-one__bg" style="background-image: url(assets/images/backgrounds/slider-1-2.jpg);"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-10 col-lg-10">
                                        <div class="hero-slider-one__content">
                                            <h5 class="hero-slider-one__sub-title">Welcome To</h5>
                                            <!-- /.slider-sub-title -->
                                            <h2 class="hero-slider-one__title">
                                                Sree Varsha <br>Engineering Works
                                                <span class="hero-slider-one__title__overlay-group">
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                </span>
                                            </h2>
                                            <h5 class="hero-slider-one__sub-title">Hydroponics</h5>
                                            <!-- /.slider-title -->
                                            <div class="hero-slider-one__btn">
                                                <a href="https://wa.me/+919047039929" class="boskery-btn">
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__text">For Enquiry</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                                <!-- slider-btn -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.slider-item -->
                    <div class="item">
                        <div class="hero-slider-one__item">
                            <div class="hero-slider-one__bg" style="background-image: url(assets/images/backgrounds/slider-1-3.jpg);"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-10 col-lg-10">
                                        <div class="hero-slider-one__content">
                                            <h5 class="hero-slider-one__sub-title">Welcome To</h5>
                                            <!-- /.slider-sub-title -->
                                            <h2 class="hero-slider-one__title">
                                                Sree Varsha <br>Engineering Works
                                                <span class="hero-slider-one__title__overlay-group">
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                    <span class="hero-slider-one__title__overlay"></span>
                                                </span>
                                            </h2>
                                            <h5 class="hero-slider-one__sub-title">End caps</h5>
                                            <!-- /.slider-title -->
                                            <div class="hero-slider-one__btn">
                                                <a href="https://wa.me/+919047039929" class="boskery-btn">
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__hover"></span>
                                                    <span class="boskery-btn__text">For Enquiry</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                                <!-- slider-btn -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.slider-item -->
                </div>
            </section>
            <!-- /.hero-slider-one -->

            <section class="about-three section-space" id="about">
                <div class="container">
                    <div class="row gutter-y-60">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1500ms">
                            <div class="about-three__image">
                                <img src="assets/images/about/about-3-1.jpg" alt="about image" class="about-three__image__one" />
                                <div class="about-three__image__inner">
                                    <img src="assets/images/about/about-3-2.jpg" alt="about image" class="about-three__image__two" />
                                </div>
                                <!-- /.about-three__image__inner -->
                                <div class="about-three__experience">
                                    <div class="about-three__experience__bg" style="background-image: url(assets/images/shapes/about-shape-3-1.png);"></div>
                                    <!-- /.about-three__experience__bg -->
                                    <div class="about-three__experience__content">
                                        <div class="about-three__experience__text">
                                            <h4 class="about-three__experience__title">
                                                years of <br />
                                                experience
                                            </h4>
                                            <!-- /.about-three__experience__title -->
                                        </div>
                                        <!-- /.about-three__experience__text -->
                                        <h4 class="about-three__experience__year">15+</h4>
                                        <!-- /.about-three__experience__year -->
                                    </div>
                                    <!-- /.about-three__experience__content -->
                                </div>
                                <!-- /.about-three__experience -->
                            </div>
                            <!-- /.about-three__image -->
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1500ms">
                            <div class="about-three__content">
                                <div class="sec-title @@extraClassName">
                                    <h6 class="sec-title__tagline">about us</h6>
                                    <!-- /.sec-title__tagline -->

                                    <h2 class="sec-title__title">
                                        Sree Varsha Engineering Works
                                    </h2>
                                    <!-- /.sec-title__title -->
                                </div>
                                <!-- /.sec-title -->
                                <p class="about-three__text">
                                    <b>Sree Varsha Engineering Works</b> is the well known <b>UPVC Window HARDWARE AND DOOR HARDWARE</b> manufacturer in Coimbatore, Tamilnadu India. The company started its conception in the year 2010 and since date has shown quality with growth via its distinct product approach. It is endowed with a team of experienced professionals assuring to the quality and time on deliver the best of services for our clients. The updated experience and relevant grade of raw material used for the manufacturing of all our products will make us one of the best UPVC hardware manufacturing company in India The company up date product range deliberately tends to meet the current and future industry demands.
                                </p>
                                <!-- /.about-three__text -->
                                <div class="about-three__bottom">
                                    <a href="about.php" class="boskery-btn">
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__hover"></span>
                                        <span class="boskery-btn__text">Read More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                                <!-- /.about-three__bottom -->
                            </div>
                            <!-- /.about-three__content -->
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
                <div class="about-three__shape">
                    <img src="assets/images/shapes/about-shape-3-2.png" alt="about shape" class="about-three__shape-one" />
                    <div class="about-three__shape__image wow fadeInLeft" data-wow-duration="1500ms">
                        <img src="assets/images/shapes/about-shape-3-3.png" alt="about shape" />
                    </div>
                    <!-- /.about-three__shape__image -->
                </div>
                <!-- /.about-three__shape -->
            </section>
            <!-- /.about-three section-space -->

            <section class="counter-one section-space">
                <div class="counter-one__bg boskery-jarallax" data-jarallax data-speed="0.3" style="background-image: url(assets/images/backgrounds/counter-bg-1.jpg);"></div>
                <!-- /.counter-one__bg -->
                <div class="container">
                    <div class="counter-one__wrapper">
                        <div class="counter-one__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                            <div class="counter-one__item__inner">
                                <div class="counter-one__box count-box">
                                    <h3 class="counter-one__count-text count-text" data-stop="15" data-speed="1500">0</h3>
                                    <h3 class="counter-one__count-text">+</h3>
                                </div>
                                <!-- /.counter-one__box -->
                                <h4 class="counter-one__title">Year of Experience</h4>
                                <!-- /.counter-one__title -->
                            </div>
                            <!-- /.counter-one__item__inner -->
                        </div>
                        <!-- /.counter-one__item -->
                        <div class="counter-one__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                            <div class="counter-one__item__inner">
                                <div class="counter-one__box count-box">
                                    <h3 class="counter-one__count-text count-text" data-stop="50" data-speed="1500">0</h3>
                                    <h3 class="counter-one__count-text">k+</h3>
                                </div>
                                <!-- /.counter-one__box -->
                                <h4 class="counter-one__title">Quality Materials</h4>
                                <!-- /.counter-one__title -->
                            </div>
                            <!-- /.counter-one__item__inner -->
                        </div>
                        <!-- /.counter-one__item -->
                        <div class="counter-one__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <div class="counter-one__item__inner">
                                <div class="counter-one__box count-box">
                                    <h3 class="counter-one__count-text count-text" data-stop="10" data-speed="1500">0</h3>
                                    <h3 class="counter-one__count-text">+</h3>
                                </div>
                                <!-- /.counter-one__box -->
                                <h4 class="counter-one__title">Employees</h4>
                                <!-- /.counter-one__title -->
                            </div>
                            <!-- /.counter-one__item__inner -->
                        </div>
                        <!-- /.counter-one__item -->
                        <div class="counter-one__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                            <div class="counter-one__item__inner">
                                <div class="counter-one__box count-box">
                                    <h3 class="counter-one__count-text count-text" data-stop="30" data-speed="1500">0</h3>
                                    <h3 class="counter-one__count-text">k+</h3>
                                </div>
                                <!-- /.counter-one__box -->
                                <h4 class="counter-one__title">Happy Clients</h4>
                                <!-- /.counter-one__title -->
                            </div>
                            <!-- /.counter-one__item__inner -->
                        </div>
                        <!-- /.counter-one__item -->
                    </div>
                    <!-- /.counter-one__wrapper -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.counter-one section-space -->

            <section class="why-choose-one section-space-two" id="why-choose" style="background-image: url(assets/images/shapes/technologies-shape-bg-1-1.png);">
                <div class="container">
                    <div class="sec-title sec-title--center">
                        <h6 class="sec-title__tagline">Our Services</h6>
                        <!-- /.sec-title__tagline -->

                        <h2 class="sec-title__title">
                            Sree Varsha Engineering Works
                        </h2>
                        <!-- /.sec-title__title -->
                    </div>
                    <!-- /.sec-title -->
                    <div class="row gutter-y-30 align-items-center">
                        <div class="col-lg-4 wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="00ms">
                            <div class="why-choose-one__content">
                                <div class="why-choose-one__item">
                                    <div class="why-choose-one__item__icon">
                                        <i class="fas fa-tools"></i> <!-- UPVC Hardware -->
                                    </div>
                                    <div class="why-choose-one__item__content">
                                        <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">UPVC Window & Door Hardware</a></h4>
                                    </div>
                                </div>

                                <div class="why-choose-one__item">
                                    <div class="why-choose-one__item__icon">
                                        <i class="fas fa-clock"></i> <!-- Timely Delivery -->
                                    </div>
                                    <div class="why-choose-one__item__content">
                                        <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">On-Time Delivery</a></h4>
                                    </div>
                                </div>

                                <div class="why-choose-one__item">
                                    <div class="why-choose-one__item__icon">
                                        <i class="fas fa-certificate"></i> <!-- Quality Assurance -->
                                    </div>
                                    <div class="why-choose-one__item__content">
                                        <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">Quality Assurance</a></h4>
                                    </div>
                                </div>
                            </div>
                            <!-- /.why-choose-one__content -->
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-4 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <div class="why-choose-one__image" style="background: unset;">
                                <img src="assets/images/shapes/why-choose-shape-1-1.png" alt="why-choose-shape" />
                            </div>
                            <!-- /.why-choose-one__image -->
                        </div>
                        <!-- /.col-lg-4 -->
                        <div class="col-lg-4 wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="00ms">
                            <div class="why-choose-one__item">
                                <div class="why-choose-one__item__icon">
                                    <i class="fas fa-cogs"></i> <!-- Custom Manufacturing -->
                                </div>
                                <div class="why-choose-one__item__content">
                                    <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">Customized Production</a></h4>
                                </div>
                            </div>

                            <div class="why-choose-one__item">
                                <div class="why-choose-one__item__icon">
                                    <i class="fas fa-users"></i> <!-- Customer Centric -->
                                </div>
                                <div class="why-choose-one__item__content">
                                    <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">Customer-Centric Service</a></h4>
                                </div>
                            </div>

                            <div class="why-choose-one__item">
                                <div class="why-choose-one__item__icon">
                                    <i class="fas fa-globe-asia"></i> <!-- Pan India Reach -->
                                </div>
                                <div class="why-choose-one__item__content">
                                    <h4 class="why-choose-one__item__title m-0"><a href="services.php" style="color: unset;">Pan India Reach</a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-4 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.why-choose-one section-space-two -->

            <?php if (!empty($offset)) { ?>
            <section class="product-one section-space-two" id="shop">
                <style>
                    .product__item {
                        min-height: 100%;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }
                </style>
                <div class="container">
                    <div class="sec-title sec-title--center">
                        <h6 class="sec-title__tagline">Our Products</h6>
                        <h2 class="sec-title__title">Sree Varsha Engineering Works</h2>
                    </div>
                    <div class="row gutter-y-30">
                        <?php
                            foreach ($offset as $offer) { 
                                $off = Operations::getOfferlist($offer['title']);
                                $images = explode(',', $off['images']);
                        ?>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="product__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                                <a href="product_single.php?id=<?= $off['id'] ?>">
                                    <div class="product__item__image">
                                        <?php foreach ($images as $i => $img) { if ($i == 0) { ?>
                                        <img src="dashboard/uploads/products/<?= $img ?>" alt="<?= $off['name'] ?>" />
                                        <?php } } ?>
                                    </div>
                                </a>
                                <div class="product__item__content">
                                    <h4 class="product__item__title"><a href="product_single.php?id=<?= $off['id'] ?>"><?= $off['name'] ?></a></h4>
                                    <div class="product__item__price text-danger"><?= $offer['offer'] ?></div>
                                    <div class="product__item__price"><del>₹<?= $offer['price'] ?></del> / ₹<?= $off['of'] ?></div>
                                    <button class="boskery-btn product__item__link add-to-cart" 
                                            data-id="<?= $off['id']; ?>" 
                                            data-name="<?= $offer['title']; ?>" 
                                            data-price="<?= $offer['price'] ?>" 
                                            data-code="<?= $off['code']; ?>" 
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
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="product-one__shape">
                    <img src="assets/images/shapes/product-shape-1-1.png" alt="product shape" class="product-one__shape__image" />
                </div>
            </section>
            <?php } ?>

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

</html>