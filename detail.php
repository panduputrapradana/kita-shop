<?php
require_once 'function/detail.php';

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
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>

    <?php

    $id = $_GET['id'];

    $row = read($id);

    ?>

    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="./assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"><?= $row['product_name']; ?></h4>
                            <p class="mb-3">Category: <?= $row['category_name']; ?></p>
                            <h5 class="fw-bold mb-3">Rp.<?= $row['product_price']; ?></h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <!-- <div class="input-group quantity mb-5" style="width: 100px;">
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
                            </div> -->
                            <?php
                            if ($row['product_stock'] > 0) { ?>
                                <form action="function/cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
                                    <input type="hidden" name="t_item_qty" value="1" min="1" max="<?= $p['product_stock']; ?>">
                                    <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                </form>
                            <?php } else { ?>
                                <span style="color:red;">Stok Habis</span>
                            <?php }
                            ?>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p><?= $row['product_description']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="mb-4">
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
                            <h4 class="mb-4">Other products</h4>
                            <?php
                            $rows = other();

                            foreach ($rows as $row) {
                            ?>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded" style="width: 100px; height: 100px;">
                                        <img src="./assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid rounded" alt="Image">
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
                                <a href="product.php" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Other products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <?php
                    $rows = other2();

                    foreach ($rows as $row) {
                    ?>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="./assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $row['category_name']; ?></div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?= $row['product_name']; ?></h4>
                                <p><?= substr($row['product_description'], 0, 100); ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">Rp.<?= $row['product_price']; ?></p>
                                    <a href="detail.php?id=<?= $row['product_id']; ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-eye me-2 text-primary"></i> Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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