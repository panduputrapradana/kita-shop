<?php

require_once 'function/tracking.php';

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
                    <?php
                    $rows = [];
                    $summary = null;
                    if (isset($_POST['tracking']) && !empty($_POST['transaction_id'])) {
                        $transaction_id = $_POST['transaction_id'];

                        $rows = track($transaction_id);
                        $summary = track2($transaction_id);
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-item">
                            <label class="form-label my-3">Input Code<sup>*</sup></label>
                            <input type="text" class="form-control" name="transaction_id">
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <div class="col-4">
                                <button type="submit" name="tracking" class="btn btn-sm border-secondary py-3 px-4 text-uppercase w-100 text-primary">Tracking</button>
                            </div>
                        </div>
                    </form>
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
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($summary) {
                            foreach ($rows as $row) { ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/uploads/<?= $row['product_pict']; ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $row['product_name']; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $row['product_price']; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $row['t_item_qty']; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?= $row['product_price'] * $row['t_item_qty']; ?></p>
                                    </td>

                                </tr>
                            <?php
                            }
                            $row = [];
                            if (isset($_POST['tracking'])) {
                                $transaction_id = $_POST['transaction_id'];
                                if (isset($transaction_id)) {
                                    $row = track2($transaction_id);
                                }
                            }
                            ?>
                            <tr>
                                <td>Total Harga</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= $row['transaction_total']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php if ($row['transaction_status'] == 'Diproses') { ?>
                                        <span class="btn btn-warning"><?= $row['transaction_status']; ?></span>
                                    <?php } else { ?>
                                        <span class="btn btn-success"><?= $row['transaction_status']; ?></span>
                                    <?php } ?>

                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="function/invoice.php?trx=<?= $row['transaction_id']; ?>" target="_blank" class="btn btn-success">Cetak Invoice</a>
                                </td>
                            </tr>
                        <?php
                        } else if (isset($_POST['tracking'])) { ?>
                            <div class="alert alert-danger">
                                Kode transaksi tidak ditemukan!
                            </div>

                        <?php
                        }

                        ?>




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