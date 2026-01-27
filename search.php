<?php
require_once 'function/search.php';

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
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Our Products</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4 mb-4">
                        <div class="col-xl-3">
                            <form action="" action="POST">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" name="keyword" placeholder="keywords" aria-describedby="search-icon-1">
                                    <button type="submit" name="search">
                                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <?php
                                            $rows = category();

                                            foreach ($rows as $row) {
                                            ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"><i class="fas fa-apple-alt me-2"></i><?= $row['category_name']; ?></a>
                                                        <span>(<?= $row['total_product']; ?>)</span>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Other products</h4>
                                    <?php
                                    $rows = other();

                                    foreach ($rows as $row) {
                                    ?>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="./assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2"><?= $row['product_name']; ?></h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">Rp.<?= $row['product_price']; ?></h5>
                                                    <h5 class="text-danger text-decoration-line-through">Rp.<?= $row['product_price'] + 5000; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="d-flex justify-content-center my-4">
                                        <a href="product.php" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="./assets/frontend/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                <?php
                                $keyword = $_GET['keyword'];
                                $rows = read($keyword);

                                foreach ($rows as $row) {
                                ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="./assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $row['category_name']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?= $row['product_name']; ?></h4>
                                                <p><?= substr($row['product_description'], 0, 100); ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp.<?= $row['product_price']; ?></p>
                                                    <a href="detail.php?id=<?= $row['product_id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-eye me-2 text-primary"></i> Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
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