<?php

include "libs/load.php";

// Start a session
Session::start();

// Get user and account details
$user = Operations::getUser();
$userAccount = Operations::getUserAccount();

// Check if the user is logged in
$isLoggedIn = Session::get('Loggedin');

// Redirect if the user is already logged in
if ($isLoggedIn)
{
    header('Location: index.php');
    exit;
}

$error = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both username and password keys exist in $_POST
    if (isset($_POST['user']) && isset($_POST['password'])) {

        $user = $_POST['user'] ?? "";
        $pass = $_POST['password'] ?? "";

		// Call User::login
		$error = User::login($user, $pass);
    }

    if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Call the register method
        $error = User::register($name, $password, $email, $phone);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <title>Sree Varsha Engineering Works</title>

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
                    <h2 class="page-header__title">Log In & Register</h2>
                    <ul class="boskery-breadcrumb list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><span>Log In & Register</span></li>
                    </ul>
                    <!-- /.thm-breadcrumb list-unstyled -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /.page-header -->

            <section class="login-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="login-page__inner">
                                <div class="login-page__image wow fadeInLeft" data-wow-duration="1500ms">
                                    <img src="assets/images/resources/login-1-1.jpg" alt="login" />
                                </div>
                                <!-- /.login-page__image -->
                                <div class="login-page__wrap login-page__main-tab-box tabs-box wow fadeInRight" data-wow-duration="1500ms">
                                    <div class="login-page__wrap__bg" style="background-image: url('assets/images/shapes/login-bg-1.png');"></div>
                                    <!-- /.login-page__wrap__bg -->
                                    <div class="login-page__wrap__top">
                                        <div class="login-page__wrap__content">
                                            <h3 class="login-page__title">welcome</h3>
                                        </div>
                                        <!-- /.login-page__content -->
                                        <ul class="tab-buttons">
                                            <li data-tab="#login" class="tab-btn boskery-btn active-btn">
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__text">log in</span>
                                            </li>
                                            <li data-tab="#register" class="tab-btn boskery-btn">
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__hover"></span>
                                                <span class="boskery-btn__text">register</span>
                                            </li>
                                        </ul>
                                        <!-- /.tab-buttons -->
                                    </div>
                                    <!-- /.login-page__wrap__top -->
                                    <div class="tabs-content">
                                        <div class="tab active-tab fadeInUp animated" data-wow-delay="200ms" id="login" style="display: block;">
                                            <span class="login-page__tab-title">sign in your account</span>
                                            <form class="login-page__form" method="POST">
                                                <div class="login-page__form__input-box">
                                                    <input type="text" name="user" placeholder="Username" required/>
                                                    <span class="icon-email"></span>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                <div class="login-page__form__input-box">
                                                    <input type="password" name="password" placeholder="Password" class="login-page__password" required/>
                                                    <span class="icon-padlock"></span>
                                                    <i class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></i>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                <p class="<?= $error ? 'text-danger' : 'text-success' ?>"><?= $error ?></p>
                                                <div class="login-page__form__input-box login-page__form__input-box--button">
                                                    <button type="submit" name="submit" class="boskery-btn login-page__form__btn">log in</button>
                                                </div>
                                                <!-- /.login-page__form__button -->
                                            </form>
                                            <!-- /.login-page__form -->
                                        </div>
                                        <!-- /.login-tab -->

                                        <div class="tab fadeInUp animated" data-wow-delay="200ms" id="register" style="display: none;">
                                            <span class="login-page__tab-title">sign up your account</span>
                                            <form class="login-page__form" method="POST">
                                                <div class="login-page__form__input-box">
                                                    <input type="text" name="name" placeholder="Username" required/>
                                                    <span class="icon-user"></span>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                 <div class="login-page__form__input-box">
                                                    <input type="email" name="email" placeholder="Email Address" required/>
                                                    <span class="icon-email"></span>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                 <div class="login-page__form__input-box">
                                                    <input type="phone" name="phone" placeholder="Phone Number" required/>
                                                    <span class="fa fa-phone"></span>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                <div class="login-page__form__input-box">
                                                    <input type="password" name="password" placeholder="Password" class="login-page__password" required/>
                                                    <span class="icon-padlock"></span>
                                                    <i class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></i>
                                                </div>
                                                <!-- /.login-page__form__input-box -->
                                                <div class="login-page__form__input-box login-page__form__input-box--button">
                                                    <button type="submit" name="submit" class="boskery-btn login-page__form__btn">Register</button>
                                                </div>
                                                <!-- /.login-page__form__button -->
                                            </form>
                                            <!-- /.login-page__form -->
                                        </div>
                                        <!-- /.register-tab -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                            </div>
                            <!-- /.login-page__inner -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.login-page -->

            <?php include "temp/footer.php" ?>

    </body>
</html>