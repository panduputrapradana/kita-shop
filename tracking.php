<?php

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

$title = 'Tracking';

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
        <h1 class="text-center text-white display-6">Tracking</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Tracking</li>
        </ol>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-end">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="form-item">
                        <label class="form-label my-3">Input Code<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <div class="col-4"><button type="button" class="btn btn-sm border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button></div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">Big Banana</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">2.99 $</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">2.99 $</p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>
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