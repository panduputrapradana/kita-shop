<?php

require_once 'functions/category.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$title = 'Products';
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
                        <a href="createProduct.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
                        </a>
                    </div>


                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="" method="POST">
                                    <input type="hidden" name="delete_category_id" id="delete_category_id">
                                    <input type="hidden" name="action" value="delete">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalTitle">Tambah Data <?= $title; ?></h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
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
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th width='200'>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Status</th>
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
                        fetch("./api/products/read.php")
                            .then(response => response.json())
                            .then(result => {
                                let rows = "";
                                let no = 1;
                                result.data.forEach(item => {
                                    rows += `
                                    <tr>
                                    <td>${no++}</td>
                                    <td>${item.product_name}</td>
                                    <td>${item.category_name}</td>
                                    <td>${item.product_price}</td>
                                    <td>${item.product_stock}</td>
                                    <td>
                                         ${item.product_status == 1 
                                            ? '<span class="badge badge-success">Ready</span>' 
                                            : '<span class="badge badge-secondary">Tidak Ready</span>'}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btnEdit" data-id="${item.product_id}">Edit</button>
                                        <button class="btn btn-danger btnDelete" data-id="${item.product_id}">Delete</button>
                                    </td>
                                    </tr>
                                `;
                                });
                                document.getElementById("productTable").innerHTML = rows;
                            })
                            .catch(error => console.error(error));
                    </script>


                    <script>
                        document.addEventListener("click", function(e) {
                            if (e.target.classList.contains("btnEdit")) {
                                let id = e.target.dataset.id;
                                window.location.href = "editProduct.php?id=" + id;
                            }
                        });

                        document.addEventListener("click", function(e) {
                            if (e.target.classList.contains("btnDelete")) {
                                let id = e.target.dataset.id;

                                if (!confirm("Yakin ingin menghapus product ini?")) return;

                                let formData = new FormData();
                                formData.append("action", "delete");
                                formData.append("product_id", id);

                                fetch("./api/products/delete.php", {
                                        method: "POST",
                                        body: formData
                                    })
                                    .then(res => res.json())
                                    .then(result => {
                                        alert(result.message);
                                        if (result.status) {
                                            location.reload(); // refresh tabel
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