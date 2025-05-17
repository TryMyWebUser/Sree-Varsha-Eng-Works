<?php
    include "../libs/load.php";
    Session::start();
    $userAccount = Operations::getUserAccount();
    $profiles = Operations::getAllProfiles();
    $count = Operations::getUserCount();
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
                    <div class="card my-3">
                        <div class="card-header position-relative min-vh-25 mb-7">
                            <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image: url(assets/img/generic/4.jpg);"></div>
                            <!--/.bg-holder-->
                            <div class="avatar avatar-5xl avatar-profile">
                                <img class="rounded-circle img-thumbnail shadow-sm" src="<?= $userAccount['avatar']; ?>" width="200" alt="" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-1">
                                        <?= $userAccount['user']; ?>
                                        <span data-bs-toggle="tooltip" data-bs-placement="right" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span>
                                    </h4>
                                    <p class="text-500"><?= $userAccount['location']; ?></p>
                                    <div class="border-bottom border-dashed my-4 d-lg-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-body-tertiary">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-0" id="followers">Users <span class="d-none d-sm-inline-block">(<?= $count ?>)</span></h5>
                                </div>
                                <div class="col">
                                    <form>
                                        <div class="row g-0">
                                            <div class="col"><input class="form-control form-control-sm" type="text" placeholder="Search..." /></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-body-tertiary px-1 py-0">
                            <div class="row g-0 text-center fs-10">
                                <?php
                                    foreach ($profiles as $profile) {
                                ?>
                                <div class="col-6 col-md-4 col-lg-3 col-xxl-2 mb-1">
                                    <div class="bg-white dark__bg-1100 p-3 h-100">
                                        <a href="profile.php">
                                            <img class="img-thumbnail img-fluid rounded-circle mb-3 shadow-sm" src="<?= $profile['avatar']; ?>" alt="" width="100" />
                                        </a>
                                        <h6 class="mb-1"><a href="profile.php"><?= $profile['user']; ?></a></h6>
                                    </div>
                                </div>
                                <?php } ?>
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