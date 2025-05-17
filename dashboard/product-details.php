<?php

    include "../libs/load.php";
    
    Session::start();
    $userAccount = Operations::getUserAccount();
    $products = Operations::getSingleProduct();
    
    if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {

        if ($_GET['id'] ?? null) {

?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
    
    <?php include "temp/head.php"; ?>

    <style>
        .row {
            display: flex;
            align-items: stretch;
            width: -webkit-fill-available;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: row;
        }
        .container {
            height: 100%;
        }
        .card-body img {
            max-width: 100%;
            height: auto;
        }
        .card {
            min-height: inherit;
        }
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

    <body>
        <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
        <main class="main" id="top">
            <div class="container" data-layout="container">
                
                <?php include "temp/header.php"; ?>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <div class="product-slider" id="galleryTop">
                                        <div
                                            class="swiper theme-slider position-lg-absolute all-0"
                                            data-swiper='{"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"thumb":{"spaceBetween":5,"slidesPerView":5,"loop":true,"freeMode":true,"grabCursor":true,"loopedSlides":5,"centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"parent":"#galleryTop"},"slideToClickedSlide":true}'
                                        >
                                            <div class="swiper-wrapper h-100">
                                                <?php $images = explode(',', $products['images']); foreach ($images as $image) { ?>
                                                <div class="swiper-slide h-100">
                                                    <img class="rounded-1 object-fit-cover h-100 w-100" src="uploads/products/<?= $image ?>" alt="Image Not Found" />
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="swiper-nav">
                                                <div class="swiper-button-next swiper-button-white"></div>
                                                <div class="swiper-button-prev swiper-button-white"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h5><?= $products['name'] ?></h5>
                                    <p class="fs-10"><?= $products['dec']; ?></p>
                                    <h4 class="d-flex align-items-center">
                                        <span class="text-warning me-2" style="font-family: auto;">₹<?= $products['of']; ?></span>
                                    </h4>
                                    <p class="fs-10">Stock: <strong class="<?= ($products['status'] === 'Available') ? 'text-success' : 'text-danger' ?>"><?= $products['status']; ?></strong></p>
                                    <table>
                                        <tbody>
                                            <?php
                                                $table = explode(',,', $products['table']);
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
                                    <div class="row mt-4" style="justify-content: space-evenly;">
                                        <!-- <div class="col-auto pe-0">
                                            <div class="input-group input-group-sm" data-quantity="data-quantity">
                                                <button class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="minus">-</button>
                                                <input class="form-control text-center input-quantity input-spin-none" type="number" min="0" value="0" aria-label="Amount (to the nearest dollar)" style="max-width: 50px;" />
                                                <button class="btn btn-sm btn-outline-secondary border border-300" data-field="input-quantity" data-type="plus">+</button>
                                            </div>
                                        </div>
                                        <div class="col-auto px-2 px-md-3">
                                            <a class="btn btn-sm btn-primary" href="#!"><span class="fas fa-cart-plus me-sm-2"></span><span class="d-none d-sm-inline-block">Add To Cart</span></a>
                                        </div> -->
                                        <div class="col-auto px-0 me-3">
                                            <a class="btn btn-sm btn-outline-secondery border border-300" href="edit-product.php?id=<?= $products['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product">
                                                <span class="fas fa-pencil-alt"></span>
                                            </a>
                                        </div>
                                        <div class="col-auto px-0">
                                            <a class="btn btn-sm btn-outline-danger border border-300" href="delete-product.php?id=<?= $products['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Product">
                                                <span class="fas fa-trash"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'temp/footer.php'; ?>
    </body>
</html>
<?php
        } else {
            header('Location: 404.php');
        }
    } else {
        header("Location: 404.php");
    }
?>