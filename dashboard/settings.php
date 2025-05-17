<?php

include "../libs/load.php";
Session::start();
$user = Operations::getUser();
$userAccount = Operations::getUserAccount();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the avatar is uploaded
    if (isset($_FILES['avatar']) && isset($_POST['submit'])) {
        $avatar = $_FILES['avatar']; // Pass the entire file array to the function
        $fileSize = $_FILES['avatar']['size'];
        $error = User::setAvatar($avatar, $fileSize);
    }

    if (isset($_POST['old']) && isset($_POST['new']) && isset($_POST['conf']) && isset($_POST['submit'])) {
        $old = $_POST['old'];
        $new = $_POST['new'];
        $conf = $_POST['conf'];

        // Call the register method
        $error = User::setNewPass($old, $new, $conf);
    }

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['submit'])) {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $locat = $_POST['locate'];

        // Call the register method
        $error = User::setUser($user, $email, $phone, $locat);
    }    
}

if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    
    <?php include "temp/head.php"; ?>

    <body>
        <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
        <main class="main" id="top">
            <div class="container" data-layout="container">
                <?php include "temp/header.php"; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card my-3 btn-reveal-trigger">
                                <div class="card-header position-relative min-vh-25 mb-8">
                                    <div class="cover-image">
                                        <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image: url(assets/img/generic/4.jpg);"></div>
                                        <!--/.bg-holder-->
                                        <p class="position-absolute <?= ($error) ? 'text-success' : 'text-danger' ?>"><?= $error ?></p>
                                    </div>
                                    
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                                            <div class="h-100 w-100 rounded-circle overflow-hidden position-relative">
                                                <img src="<?= $userAccount['avatar']; ?>" width="200" alt="" />
                                                <input class="d-none" id="profile-image" type="file" name="avatar" required>
                                                <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image">
                                                    <span class="bg-holder overlay overlay-0"></span>
                                                    <span class="z-1 text-white dark__text-white text-center fs-10">
                                                        <span class="fas fa-camera"></span>
                                                        <span class="d-block">Update</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Save button for updating avatar -->
                                        <button type="submit" name="submit" class="btn btn-primary rounded-3 shadow-sm px-3 position-absolute end-0 me-3">Save</button>
                                    </form>
                                    
                                    <script>
                                        document.getElementById('profile-image').addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    document.querySelector('.avatar-profile img').src = e.target.result;
                                                };
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="col-lg-8 pe-lg-2">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Profile Settings</h5>
                                </div>
                                <div class="card-body bg-body-tertiary">
                                    <form class="row g-3" method="POST">
                                        <div class="col-lg-6"><label class="form-label" for="username">Username</label><input class="form-control" name="username" type="text" value="<?= $user['username']; ?>" /></div>
                                        <div class="col-lg-6"><label class="form-label" for="email">Email</label><input class="form-control" name="email" type="email" value="<?= $user['email']; ?>" /></div>
                                        <div class="col-lg-6"><label class="form-label" for="phone">Phone</label><input class="form-control" name="phone" type="phone" value="<?= $user['phone']; ?>" /></div>
                                        <div class="col-lg-6"><label class="form-label" for="location">Location</label><input class="form-control" name="locate" type="text" value="<?= $userAccount['location']; ?>" /></div>
                                        <div class="col-12 d-flex justify-content-end"><button class="btn btn-primary" name="submit" type="submit">Update</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 ps-lg-2">
                            <div class="sticky-sidebar">
                                <!-- <div class="card mb-3 overflow-hidden">
                                    <div class="card-header">
                                        <h5 class="mb-0">Account Settings</h5>
                                    </div>
                                    <div class="card-body bg-body-tertiary">
                                        <h6 class="fw-bold">
                                            Who can see your profile ?
                                            <span class="fs-11 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Only The group of selected people can see your profile">
                                                <span class="fas fa-question-circle"></span>
                                            </span>
                                        </h6>
                                        <div class="ps-2">
                                            <div class="form-check mb-0 lh-1">
                                                <input class="form-check-input" type="radio" value="" id="everyone" name="view-settings" /><label class="form-check-label mb-0" for="everyone">Everyone</label>
                                            </div>
                                            <div class="form-check mb-0 lh-1">
                                                <input class="form-check-input" type="radio" value="" id="my-followers" checked="checked" name="view-settings" /><label class="form-check-label mb-0" for="my-followers">My followers</label>
                                            </div>
                                            <div class="form-check mb-0 lh-1"><input class="form-check-input" type="radio" value="" id="only-me" name="view-settings" /><label class="form-check-label mb-0" for="only-me">Only me</label></div>
                                        </div>
                                        <h6 class="mt-2 fw-bold">
                                            Who can tag you ?
                                            <span class="fs-11 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Only The group of selected people can tag you"><span class="fas fa-question-circle"></span></span>
                                        </h6>
                                        <div class="ps-2">
                                            <div class="form-check mb-0 lh-1">
                                                <input class="form-check-input" type="radio" value="" id="tag-everyone" name="tag-settings" /><label class="form-check-label mb-0" for="tag-everyone">Everyone</label>
                                            </div>
                                            <div class="form-check mb-0 lh-1">
                                                <input class="form-check-input" type="radio" value="" id="group-members" checked="checked" name="tag-settings" /><label class="form-check-label mb-0" for="group-members">Group Members</label>
                                            </div>
                                        </div>
                                        <div class="border-dashed-bottom my-3"></div>
                                        <div class="form-check mb-0 lh-1">
                                            <input class="form-check-input" type="checkbox" id="userSettings1" checked="checked" /><label class="form-check-label mb-0" for="userSettings1">Allow users to show your followers</label>
                                        </div>
                                        <div class="form-check mb-0 lh-1">
                                            <input class="form-check-input" type="checkbox" id="userSettings2" checked="checked" /><label class="form-check-label mb-0" for="userSettings2">Allow users to show your email</label>
                                        </div>
                                        <div class="form-check mb-0 lh-1">
                                            <input class="form-check-input" type="checkbox" id="userSettings3" /><label class="form-check-label mb-0" for="userSettings3">Allow users to show your experiences</label>
                                        </div>
                                        <div class="border-bottom border-dashed my-3"></div>
                                        <div class="form-check form-switch mb-0 lh-1">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="checked" />
                                            <label class="form-check-label mb-0" for="flexSwitchCheckDefault">Make your phone number visible</label>
                                        </div>
                                        <div class="form-check form-switch mb-0 lh-1">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" /><label class="form-check-label mb-0" for="flexSwitchCheckChecked">Allow user to follow you</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Billing Setting</h5>
                                    </div>
                                    <div class="card-body bg-body-tertiary">
                                        <h5>Plan</h5>
                                        <p class="fs-9"><strong>Developer</strong>- Unlimited private repositories</p>
                                        <a class="btn btn-falcon-default btn-sm" href="#!">Update Plan</a>
                                    </div>
                                    <div class="card-body bg-body-tertiary border-top">
                                        <h5>Payment</h5>
                                        <p class="fs-9">You have not added any payment.</p>
                                        <a class="btn btn-falcon-default btn-sm" href="#!">Add Payment </a>
                                    </div>
                                </div> -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Change Password</h5>
                                    </div>
                                    <div class="card-body bg-body-tertiary">
                                        <form method="POST">
                                            <div class="mb-3"><label class="form-label" for="old-password">Old Password</label><input class="form-control" name="old" id="old-password" type="password" /></div>
                                            <div class="mb-3"><label class="form-label" for="new-password">New Password</label><input class="form-control" name="new" id="new-password" type="password" /></div>
                                            <div class="mb-3"><label class="form-label" for="confirm-password">Confirm Password</label><input class="form-control" name="conf" id="confirm-password" type="password" /></div>
                                            <button class="btn btn-primary d-block w-100" name="submit" type="submit">Update Password</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Danger Zone</h5>
                                    </div>
                                    <div class="card-body bg-body-tertiary">
                                        <h5 class="fs-9">Transfer Ownership</h5>
                                        <p class="fs-10">Transfer this account to another user or to an organization where you have the ability to create repositories.</p>
                                        <a class="btn btn-falcon-warning d-block" href="#!">Transfer</a>
                                        <!-- <div class="border-bottom border-dashed my-4"></div>
                                        <h5 class="fs-9">Delete this account</h5>
                                        <p class="fs-10">Once you delete a account, there is no going back. Please be certain.</p>
                                        <a class="btn btn-falcon-danger d-block" href="#!">Deactivate Account</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include "temp/footer.php"; ?>
    </body>
</html>
<?php
    } else {
        header("Location: 404.php");
    }
?>