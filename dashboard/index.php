<?php

    include "../libs/load.php";

    Session::start();
    $userAccount = Operations::getUserAccount();
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
                    <div class="row g-3 mb-3">
                        <div class="col-xxl-6 col-xl-12">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="card bg-transparent-50 overflow-hidden">
                                        <div class="card-header position-relative">
                                            <div
                                                class="bg-holder d-none d-md-block bg-card z-1"
                                                style="background-image: url(assets/img/illustrations/ecommerce-bg.png); /*background-size: 230px;*/ background-position: right bottom; z-index: -1;"
                                            ></div>
                                            <!--/.bg-holder-->
                                            <div class="position-relative z-2">
                                                <div>
                                                    <h3 class="text-primary mb-1">Welcome, <?= $userAccount['user']; ?>!</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-xxl-9 col-md-12">
                            <div class="card z-1" id="recentPurchaseTable" data-list='{"valueNames":["name","email","product","payment","amount"],"page":7,"pagination":true}'>
                                <div class="card-header">
                                    <div class="row flex-between-center">
                                        <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
                                            <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">Recent Purchases</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body px-0 py-0">
                                    <div class="table-responsive scrollbar">
                                        <table class="table table-sm fs-10 mb-0 overflow-hidden">
                                            <thead class="bg-200">
                                                <tr>
                                                    <th class="no-sort pe-1 align-middle data-table-row-action">Action</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="code">Order Code</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="name">Customer</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="email">Email</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="phone">Phone</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="location">Address</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="product-name">Product Name</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center" data-sort="quantity">Quantity</th>
                                                    <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end" data-sort="date-time">Order Date & Time</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="table-purchase-body">
                                                <?php
                                                    $carts = Operations::getCart();
                                                    if (!empty($carts)) {
                                                        foreach ($carts as $cart) {
                                                ?>
                                                <tr class="btn-reveal-trigger">
                                                    <td class="align-middle white-space-nowrap text-end">
                                                        <a class="btn btn-sm btn-falcon-default text-danger" href="delete-order.php?id=<?= $cart['id']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete Order" data-bs-original-title="Delete Order">
                                                            <svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg><!-- <span class="fas fa-trash"></span> Font Awesome fontawesome.com -->
                                                        </a>
                                                    </td>
                                                    <th class="align-middle white-space-nowrap code"><?= $cart['order_code']; ?></th>
                                                    <th class="align-middle white-space-nowrap name"><?= $cart['name']; ?></th>
                                                    <td class="align-middle white-space-nowrap email"><a href="mailto:<?= $cart['email']; ?>"><?= $cart['email']; ?></a></td>
                                                    <td class="align-middle white-space-nowrap phone"><a href="tel:<?= $cart['phone']; ?>"><?= $cart['phone']; ?></a></td>
                                                    <th class="align-middle white-space-nowrap location"><?= $cart['location']; ?></th>
                                                    <th class="align-middle white-space-nowrap product-name"><?= $cart['proname']; ?></th>
                                                    <td class="align-middle text-end quantity"><?= $cart['quantity']; ?></td>
                                                    <th class="align-middle white-space-nowrap date-time"><?= $cart['created_at']; ?></th>
                                                </tr>
                                                <?php } } else { echo "<tr><td>No Order's</td></tr>"; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row align-items-center">
                                        <div class="pagination d-none"></div>
                                        <div class="col">
                                            <p class="mb-0 fs-10"><span class="d-none d-sm-inline-block me-2" data-list-info="data-list-info"></span></p>
                                        </div>
                                        <div class="col-auto d-flex">
                                            <button class="btn btn-sm btn-primary" type="button" data-list-pagination="prev"><span>Previous</span></button>
                                            <button class="btn btn-sm btn-primary px-4 ms-2" type="button" data-list-pagination="next"><span>Next</span></button>
                                        </div>
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