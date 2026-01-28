<?php

session_start();
$cart = $_SESSION['cart'] ?? [];

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];

    if (isset($keyword)) {
        header("Location: search.php?keyword=$keyword");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php

$title = 'Product';

require_once 'layout/header.php';

?>

<body>

    <!-- Spinner Start -->
    <?php
    require_once 'layout/header.php';
    ?>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <?php
    require_once 'layout/navbar.php';
    ?>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <?php
    require_once 'layout/modal-search.php';
    ?>
    <!-- Modal Search End -->


    <!-- CONTENT STARTTTTTTT -->

    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-end">
                <form action="function/checkout_process.php" method="POST">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Nama<sup>*</sup></label>
                                    <input type="text" class="form-control" name="transaction_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <textarea name="transaction_address" id="" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">No Telepon<sup>*</sup></label>
                                    <input type="number" class="form-control" name="transaction_phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Email<sup>*</sup></label>
                                    <input type="email" class="form-control" name="transaction_email">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- CONTENT ENDDDDDDDDDDDD -->

    <!-- Copyright Start -->
    <?php
    require_once 'layout/footer.php';
    ?>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
</body>

</html>