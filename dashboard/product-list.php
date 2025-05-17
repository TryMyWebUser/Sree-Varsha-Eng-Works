<?php

    include "../libs/load.php";

    Session::start();
    $userAccount = Operations::getUserAccount();
    $products = Operations::getProducts();
    
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

                    <!-- <div class="card my-3">
                        <div class="card-body">
                            <div class="row flex-between-center">
                                <div class="col-sm-auto mb-2 mb-sm-0">
                                    <h6 class="mb-0">Showing 1-24 of 205 Products</h6>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="row gx-2 align-items-center">
                                        <div class="col-auto">
                                            <form class="row gx-2">
                                                <div class="col-auto"><small>Sort by:</small></div>
                                                <div class="col-auto">
                                                    <select class="form-select form-select-sm" aria-label="Bulk actions">
                                                        <option selected="">Best Match</option>
                                                        <option value="Refund">Newest</option>
                                                        <option value="Delete">Price</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <!- <div class="col-auto pe-0">
                                            <a class="text-600 px-1" href="product-list.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Product List"><span class="fas fa-list-ul"></span></a>
                                        </div> ->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                            <?php
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                                        $images = explode(',', $product['images']);
                                        $imageCount = count($images);
                                ?>
                                        <div class="mb-4 col-md-6 col-lg-4">
                                            <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
                                                <div class="overflow-hidden">
                                                    <div class="position-relative rounded-top overflow-hidden">
                                                        <?php if ($imageCount > 1) { ?>
                                                            <!-- Swiper Slider for Multiple Images -->
                                                            <div class="swiper theme-slider" data-swiper='{"autoplay":true,"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"navigation":{"nextEl":".swiper-button-next","prevEl":".swiper-button-prev"}}'>
                                                                <div class="swiper-wrapper">
                                                                    <?php foreach ($images as $image) { ?>
                                                                        <div class="swiper-slide">
                                                                            <a class="d-block" href="product-details.php?id=<?= $product['id']; ?>">
                                                                                <img class="rounded-top img-fluid" src="uploads/products/<?= $image ?>" alt="Image Not Found" />
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="swiper-nav">
                                                                    <div class="swiper-button-next swiper-button-white"></div>
                                                                    <div class="swiper-button-prev swiper-button-white"></div>
                                                                </div>
                                                            </div>
                                                        <?php } elseif ($imageCount === 1 && !empty($images[0])) { ?>
                                                            <!-- Show Single Image Without Swiper -->
                                                            <a class="d-block" href="product-details.php?id=<?= $product['id']; ?>">
                                                                <img class="img-fluid rounded-top" src="uploads/products/<?= $images[0] ?>" alt="Image Not Found" />
                                                            </a>
                                                        <?php } else { ?>
                                                            <!-- Default Placeholder Image -->
                                                            <a class="d-block" href="product-details.php?id=<?= $product['id']; ?>">
                                                                <img class="img-fluid rounded-top" src="assets/img/products/placeholder.jpg" alt="No Image Available" />
                                                            </a>
                                                        <?php } ?>
                                                        <span class="badge rounded-pill bg-success position-absolute mt-2 me-2 z-2 top-0 end-0">New</span>
                                                    </div>
                                                    <div class="p-3">
                                                        <h5 class="fs-9">
                                                            <a class="text-1100" href="product-details.php?id=<?= $product['id']; ?>"><?= $product['name'] ?></a>
                                                        </h5>
                                                        <p class="fs-10 mb-3">
                                                            <a class="text-500" href="product-details.php?id=<?= $product['id']; ?>"><?= $product['category']; ?></a>
                                                        </p>
                                                        <h5 class="fs-md-7 text-warning mb-0 d-flex align-items-center mb-3" style="font-family: auto;">₹<?= $product['of'] ?></h5>
                                                        <!-- <p class="fs-10 mb-1">Market Price: <del>₹< ?= $product['mp']; ?></del></p> -->
                                                        <p class="fs-10 mb-1">Stock: <strong class="<?= ($product['status'] === 'Available') ? 'text-success' : 'text-danger' ?>"><?= $product['status']; ?></strong></p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-between-center px-3" style="align-self: self-end;">
                                                    <!-- <div>
                                                        <span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span>
                                                        <span class="fa fa-star-half-alt text-warning star-icon"></span><span class="ms-1">(20)</span>
                                                    </div> -->
                                                    <div>
                                                        <a class="btn btn-sm btn-falcon-default me-2" href="edit-product.php?id=<?= $product['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Product">
                                                            <span class="fas fa-pencil-alt"></span>
                                                        </a>
                                                        <a class="btn btn-sm btn-falcon-default text-danger" href="delete-product.php?id=<?= $product['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Product">
                                                            <span class="fas fa-trash"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    } 
                                } else { 
                                    echo "Data Not Found"; 
                                } 
                                ?>                
                            </div>
                        </div>
                        <!-- <div class="card-footer bg-body-tertiary d-flex justify-content-center">
                            <div>
                                <button class="btn btn-falcon-default btn-sm me-2" type="button" disabled="disabled" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev"><span class="fas fa-chevron-left"></span></button>
                                <a class="btn btn-sm btn-falcon-default text-primary me-2" href="#!">1</a><a class="btn btn-sm btn-falcon-default me-2" href="#!">2</a>
                                <a class="btn btn-sm btn-falcon-default me-2" href="#!"> <span class="fas fa-ellipsis-h"></span></a><a class="btn btn-sm btn-falcon-default me-2" href="#!">35</a>
                                <button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next"><span class="fas fa-chevron-right"> </span></button>
                            </div>
                        </div> -->
                    </div>
                    <?php include "temp/footer.php"; ?>
    </body>
</html>
<?php
    } else {
        header("Location: 404.php");
    }
?>