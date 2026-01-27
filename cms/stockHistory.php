<?php

require_once 'functions/category.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$title = 'Stock';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once 'layout/header.php';
    ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        require_once 'layout/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require_once 'layout/navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                        <a href="createProduct.php" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                            <i
                                class="fas fa-recycle fa-sm text-white-50"></i> History
                        </a>
                    </div>


                    <!-- Modal Delete -->
                    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <input type="hidden" id="product_id">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalTitle">Update Stock</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="stock_status" class="form-label">Status</label>
                                        <select name="stock_status" id="stock_status" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option value="in">Tambah Stock</option>
                                            <option value="out">Kurangi Stock</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock_qty" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" name="stock_qty" id="stock_qty" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success" id="saveStock">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data <?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width='10'>No</th>
                                            <th>Name</th>
                                            <th>Tipe</th>
                                            <th>Qty</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Tipe</th>
                                            <th>Qty</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="productTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Script Update -->
                    <script>
                        function loadStock() {
                            fetch("./api/stock/read.php")
                                .then(response => response.json())
                                .then(result => {
                                    let rows = "";
                                    let no = 1;
                                    result.data.forEach(item => {
                                        rows += `
                                    <tr>
                                    <td>${no++}</td>
                                    <td>${item.product_name}</td>
                                    <td>${item.stock_status}</td>
                                    <td>${item.stock_qty}</td>
                                    <td>${item.stock_created_at}</td>
                                    </tr>
                                `;
                                    });
                                    document.getElementById("productTable").innerHTML = rows;
                                })
                                .catch(error => console.error(error));
                        }

                        loadStock();

                        document.addEventListener("click", function(e) {
                            if (e.target.classList.contains("btnStock")) {
                                document.getElementById("product_id").value = e.target.dataset.id;
                                $('#stockModal').modal('show');
                            }
                        });

                        document.getElementById("saveStock").addEventListener("click", function() {
                            let formData = new FormData();
                            formData.append("product_id", document.getElementById("product_id").value);
                            formData.append("stock_status", document.getElementById("stock_status").value);
                            formData.append("stock_qty", document.getElementById("stock_qty").value);

                            fetch("./api/stock/update.php", {
                                    method: "POST",
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(result => {
                                    alert(result.message);
                                    if (result.status) {
                                        $('#stockModal').modal('hide');
                                        loadStock();
                                    }
                                });
                        });
                    </script>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once 'layout/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    require_once 'layout/logout.php';
    ?>

</body>

</html>