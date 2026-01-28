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
            <div class="table-responsive">
                <form action="function/cart_update.php" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($cart as $c):
                                $subtotal = $c['price'] * $c['t_item_qty'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $c['name']; ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <input type="number" min="1" max="<?= $c['stock']; ?>" class="form-control form-control-sm text-center border-0" value="<?= $c['t_item_qty']; ?>" name="t_item_qty[<?= $c['product_id']; ?>]">
                                        </div>
                                    </td>
                                    <td>
                                        <p class=" mb-0 mt-4">Rp <?= number_format($c['price']); ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">Rp <?= number_format($subtotal); ?></p>
                                    </td>
                                    <td>
                                        <a href="function/cart_delete.php?id=<?= $c['product_id']; ?>" class="btn btn-md rounded-circle bg-light border mt-4" onclick="return confirm('Hapus Item?')">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="function/cart_clear.php" class="btn btn-success">Kosongkan Cart</a>
                    <button type="submit" class="btn btn-success">Update Cart</button>
                </form>
            </div>
            <div class="mt-5">
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">Rp <?= number_format($total); ?></p>
                        </div>
                        <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" href="checkout.php">Proceed Checkout</a>
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