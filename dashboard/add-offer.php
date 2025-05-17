<?php

    include "../libs/load.php";
    
    Session::start();
    $userAccount = Operations::getUserAccount();

    $result = "";
    
    if ($userAccount['owner'] === 'Admin' || $userAccount['owner'] === 'admin') {


        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (isset($_POST['submit']) && isset($_POST['of']) && isset($_POST['offer']) && isset($_POST['title']) && isset($_POST['sd']) && isset($_POST['ed']))
            {
                $title = $_POST['title'];
                $offer = $_POST['offer'];
                $price = $_POST['of'];
                $sd = $_POST['sd'];
                $ed = $_POST['ed'];
                $result = User::setOffer($title, $offer, $price, $sd, $ed);
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
    
    <?php include "temp/head.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <body>
        <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
        <main class="main" id="top">
            <div class="container" data-layout="container">
                <?php include "temp/header.php"; ?>
                <p><?= $result ?></p>
                    <div class="row g-0">
                        <div class="col-lg-8 pe-lg-2">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row gx-2">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="header">Product Title:</label>
                                                    <select id="select_page" name="title" class="form-control" required> 
                                                        <option selected disabled>Select a Title</option>
                                                        <?php
                                                            $title = Operations::getProducts();
                                                            foreach ($title as $t) {
                                                        ?>
                                                        <option value="<?= $t['name'] ?>"><?= $t['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="offer">Offer (%):</label>
                                                    <input class="form-control" id="offer" name="offer" type="text" required>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label" for="peice">Offer Price:</label>
                                                    <input class="form-control" id="offer-price" name="of" type="number" required>
                                                </div>
                                                <div class="col-5 mb-3">
                                                    <label class="form-label" for="sd">Offer Start Day:</label>
                                                    <input class="form-control" id="sd" type="text" name="sd" required>
                                                </div>
                                                <p class="w-auto align-self-center m-0 mt-3">To</p>
                                                <div class="col-5 mb-3">
                                                    <label class="form-label" for="ed">Offer End Day:</label>
                                                    <input class="form-control" id="ed" name="ed" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <button class="btn btn-primary" name="submit" role="button" type="submit">Add Offer</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <?php include "temp/footer.php"; ?>
                    <script>
                        $(document).ready(function () {
                            //change selectboxes to selectize mode to be searchable
                            $("select").select2();
                        });
                    </script>
    </body>
</html>
<?php
    } else {
        header("Location: 404.php");
    }
?>