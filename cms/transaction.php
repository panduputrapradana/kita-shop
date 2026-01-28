<?php

require_once 'functions/category.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$title = 'Transaction';
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
                    </div>


                    <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
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
                                        <label for="transaction_address" class="form-label">Alamat</label>
                                        <textarea id="transaction_address" readonly class="form-control"></textarea>
                                    </div>
                                    <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Products</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">SubTotal</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">Products</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">SubTotal</th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="productablex">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    <!-- <button class="btn btn-success" id="saveStock">Update</button> -->
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
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Status</th>
                                            <th>Nama</th>
                                            <th>Telepone</th>
                                            <th>Email</th>
                                            <th>Total Pembelian</th>
                                            <th width='200'>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Status</th>
                                            <th>Nama</th>
                                            <th>Telepone</th>
                                            <th>Email</th>
                                            <th>Total Pembelian</th>
                                            <th>Action</th>
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
                            fetch("./api/transaction/read.php")
                                .then(response => response.json())
                                .then(result => {
                                    let rows = "";
                                    let no = 1;
                                    result.data.forEach(item => {
                                        rows += `
                                    <tr>
                                    <td>${no++}</td>
                                    <td>${item.created_at}</td>
                                    <td>${item.transaction_id}</td>
                                    <td>
                                    <span 
                                            class="badge ${item.transaction_status == "Diproses" ? 'badge-warning':'badge-success'} btnStatus" 
                                            style="cursor:pointer"
                                            data-id="${item.transaction_id}"
                                            data-status="${item.transaction_status}"
                                            onclick="return confirm('Apakah Transaksi Selesai?')"
                                            >
                                            ${item.transaction_status}
                                    </span>
                                    </td>
                                    <td>${item.transaction_name}</td>
                                    <td>${item.transaction_phone}</td>
                                    <td>${item.transaction_email}</td>
                                    <td>${item.transaction_total}</td>
                                    <td>
                                        <a class="btn btn-secondary btnStock" 
                                            data-id="${item.transaction_id}" 
                                            data-toggle="modal" data-target="#stockModal">
                                            Detail
                                        </a>
                                    </td>
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

                        document.addEventListener("click", function(e) {
                            if (e.target.classList.contains("btnStatus")) {
                                let id = e.target.dataset.id;

                                let formData = new FormData();
                                formData.append("action", "toggle_status");
                                formData.append("transaction_id", id);

                                fetch("./api/transaction/read.php", {
                                        method: "POST",
                                        body: formData
                                    })
                                    .then(res => res.json())
                                    .then(result => {
                                        if (result.status) {

                                            if (result.new_status == 'Diproses') {
                                                e.target.classList.remove("badge-success");
                                                e.target.classList.add("badge-warning");
                                                e.target.innerText = "Diproses";
                                            } else {
                                                e.target.classList.remove("badge-warning");
                                                e.target.classList.add("badge-success");
                                                e.target.innerText = "Selesai";
                                            }
                                        }
                                    });
                            }
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