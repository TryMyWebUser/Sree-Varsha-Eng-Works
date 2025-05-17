<header class="main-header main-header--one sticky-header sticky-header--normal">
    <div class="main-header__container-fluid container-fluid">
        <div class="main-header__inner">
            <div class="main-header__logo">
                <a href="index.php">
                    <img src="assets/images/logo-dark.png" alt="Boskery HTML" width="100" />
                </a>
            </div>
            <!-- /.main-header__logo -->
            <div class="main-header__right">
                <div class="topbar">
                    <div class="container-fluid">
                        <div class="topbar__inner">
                            <ul class="list-unstyled topbar__info">
                                <li>
                                    <i class="icon-phone-call"></i>
                                    <a href="tel:9047039929">+91 9047039929</a>
                                </li>
                                <li>
                                    <i class="icon-paper-plane"></i>
                                    <a href="mailto:sree0567@gmail.com">sree0567@gmail.com</a>
                                </li>
                            </ul>
                            <!-- /.list-unstyled topbar__info -->
                            <div class="topbar__right">
                                <!-- /.list-unstyled topbar__pages -->
                                <div class="topbar__social">
                                    <a href="https://facebook.com/">
                                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                    <a href="https://instagram.com/">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                        <span class="sr-only">Instagram</span>
                                    </a>
                                    <a href="https://wa.me/9047039929">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                        <span class="sr-only">Whatsapp</span>
                                    </a>
                                    <a href="https://youtube.com/">
                                        <i class="fab fa-youtube" aria-hidden="true"></i>
                                        <span class="sr-only">YouTube</span>
                                    </a>
                                </div>
                                <!-- /.topbar__social -->
                            </div>
                            <!-- /.topbar__right -->
                        </div>
                        <!-- /.topbar__inner -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.topbar -->
                <div class="main-header__right__inner">
                    <div class="main-header__right__left">
                        <nav class="main-header__nav main-menu">
                            <ul class="main-menu__list">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>

                                <li>
                                    <a href="about.php">About Us</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#">Products</a>
                                    <ul>
                                        <?php
                                            $headline = Operations::getHeadLine();
                                            foreach ($headline as $head) {
                                        ?>
                                        <li><a href="products.php?data=<?= urlencode($head['header']) ?>"><?= $head['header'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="services.php">Services</a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact Us</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.main-header__nav -->
                    </div>
                    <!-- /.main-header__right__left -->
                    <div class="main-header__right__right">
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!-- /.mobile-nav__toggler -->
                        <div class="main-header__call">
                            <span class="main-header__call__icon icon-mobile"></span>
                            <!-- /.main-header__call__icon -->
                            <div class="main-header__call__inner">
                                <span class="main-header__call__tagline">Call Anytime</span>
                                <!-- /.main-header__call__tagline -->
                                <a href="tel:+919047039929" class="main-header__call__number">+91 9047 039 929</a>
                                <!-- /.main-header__call__number -->
                            </div>
                            <!-- /.main-header__call__inner -->
                        </div>
                        <!-- /.main-header__call -->
                        <a type="button" onclick="toggleCart()" class="main-header__cart">
                            <i class="icon-cart" aria-hidden="true"></i>
                            <span class="sr-only">Cart</span>
                        </a>
                        <?php if (!$isLoggedIn) { ?>
                            <a href="login.php" class="main-header__search">
                                <i class="icon-user" aria-hidden="true"></i>
                                <span class="sr-only">Login</span>
                            </a>
						<?php } else {
                            if ($isLoggedIn && $user): ?>
                                <a href="<?= strtolower($userAccount['owner'] ?? '') === 'admin' ? 'dashboard/' : 'profile.php'; ?>" class="main-header__search">
                                    <i class="icon-user" aria-hidden="true"></i>
                                    <span class="sr-only">Profile</span>
                                </a>
                        <?php else: ?>
                                <a href="login.php" class="main-header__search">
                                    <i class="icon-user" aria-hidden="true"></i>
                                    <span class="sr-only">Login</span>
                                </a>
                        <?php endif; } ?>
                        <a href="contact.php" class="boskery-btn main-header__btn">
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__hover"></span>
                            <span class="boskery-btn__text">get a quote</span>
                            <i class="fa fa-arrow-right"></i>
                        </a>
                        <!-- /.thm-btn main-header__btn -->
                    </div>
                    <!-- /.main-header__right__right -->
                </div>
                <!-- /.main-header__right__inner -->
            </div>
            <!-- /.main-header__right -->
        </div>
        <!-- /.main-header__inner -->
    </div>
    <!-- /.container-fluid -->
</header>
<!-- /.main-header -->

<style>
    .cart-drawer {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        width: 350px;
        height: 100%;
        background: #f8f9fa;
        box-shadow: -2px 0 10px rgba(0,0,0,0.2);
        padding: 20px;
        z-index: 1050;
        overflow-y: auto;
        transition: all 0.3s ease-in-out;
    }
    .cart-drawer.active {
        display: block;
    }
    .cart-header {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
    }
    .cart-item {
        border-bottom: 1px solid #dee2e6;
        padding: 15px 0;
    }
    .quantity-controls button {
        min-width: 32px;
    }
    .close-btn {
        font-size: 1.5rem;
        cursor: pointer;
    }
</style>

<div class="cart-drawer shadow" id="cartDrawer">
    <div class="cart-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">🛒 Shopping Cart</h5>
        <span class="close-btn text-danger" onclick="toggleCart()">&times;</span>
    </div>

    <div class="cart-content">
        <div class="cart-item d-flex align-items-center gap-3">
            <img src="https://via.placeholder.com/60" class="rounded border" alt="Product">
            <div class="flex-grow-1">
                <p class="mb-1 fw-semibold">Product Name</p>
                <p class="text-danger fw-bold mb-0">Rs. 635</p>
            </div>
            <div class="quantity-controls d-flex align-items-center">
                <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(this)">−</button>
                <span class="mx-2 quantity">1</span>
                <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(this)">+</button>
            </div>
        </div>
    </div>

    <div class="cart-footer mt-4 text-center">
        <button class="btn btn-danger w-100" onclick="handleGetQuote()">GET QUOTE</button>
    </div>
</div>
<!-- Script -->
<script>
    function toggleCart() {
        document.getElementById("cartDrawer").classList.toggle("active");
    }

    function increaseQuantity(btn) {
        const qtySpan = btn.parentElement.querySelector(".quantity");
        qtySpan.innerText = parseInt(qtySpan.innerText) + 1;
    }

    function decreaseQuantity(btn) {
        const qtySpan = btn.parentElement.querySelector(".quantity");
        const currentQty = parseInt(qtySpan.innerText);
        if (currentQty > 1) {
            qtySpan.innerText = currentQty - 1;
        }
    }
</script>