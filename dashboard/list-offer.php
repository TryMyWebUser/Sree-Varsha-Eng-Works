<?php

    include "../libs/load.php";

    Session::start();
    $userAccount = Operations::getUserAccount();
    $offer = Operations::getOffer();
    
    if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {

?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    
    <?php include 'temp/head.php'; ?>

    <body>
        <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
        <main class="main" id="top">
            <div class="container" data-layout="container">
                
                <?php include 'temp/header.php'; ?>

                
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <?php
                                    if (!empty($offer)) {
                                ?>
                                <div class="mb-4 col-md-6 col-lg-4">
                                    <div class="border rounded-1 h-100 d-flex flex-column justify-content-between">
                                        <div class="overflow-hidden">
                                            <div class="p-3">
                                                <h5 class="fs-9 text-danger">
                                                    <?= $offer['title']; ?>
                                                </h5>
                                                <h5 class="fs-9 text-danger">
                                                    <?= $offer['offer']; ?>
                                                </h5>
                                                <h5 class="fs-9">
                                                    <?= $offer['price']; ?>
                                                </h5>
                                                <p class="fs-10 mb-3">
                                                    <?= $offer['sd']; ?> To <?= $offer['ed']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-between-center px-3" style="align-self: self-end;">
                                            <div class="py-2">
                                                <a class="btn btn-sm btn-falcon-default text-danger" href="delete-offer.php?delete_id=<?= $offer['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Slider Image">
                                                    <span class="fas fa-trash"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    } else { 
                                        echo "<p>Data Not Found</p>"; 
                                    } 
                                ?>                
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