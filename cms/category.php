<?php

require_once 'functions/category.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$title = 'Category';
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
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#tambahModal">
                            <i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
                        </a>
                    </div>

                    <?php

                    if (isset($_POST['submit'])) {
                        if ($_POST['action'] == 'insert') {
                            if (save($_POST) > 0) { ?>

                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                    <strong class="text-center">Data Berhasil Ditambahkan</strong>
                                </div>
                            <?php
                            }
                        } else if ($_POST['action'] == 'update') {
                            if (edit($_POST) > 0) { ?>
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                    <strong class="text-center">Data Berhasil Diedit</strong>
                                </div>
                            <?php
                            }
                        } else if ($_POST['action'] == 'delete') {
                            if (delete($_POST) > 0) { ?>
                                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                                    <strong class="text-center">Data Berhasil Dihapus</strong>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>

                    <!-- Modal Tambah -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="" method="POST">
                                    <input type="hidden" name="category_id" id="category_id">
                                    <input type="hidden" name="action" id="action" value="insert">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle">Tambah Data <?= $title; ?></h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                            <th width='200'>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $rows = read();

                                        $no = 1;

                                        foreach ($rows as $row) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['category_name']; ?></td>
                                                <td>
                                                    <a class="btn btn-warning btnEdit"
                                                        data-id="<?= $row['category_id']; ?>"
                                                        data-name="<?= $row['category_name']; ?>"
                                                        data-toggle="modal" data-target="#tambahModal">Edit</a>
                                                    <a class="btn btn-danger btnDelete"
                                                        data-id="<?= $row['category_id']; ?>"
                                                        data-name="<?= $row['category_name']; ?>"
                                                        data-toggle="modal" data-target="#deleteModal">Delete</a>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Script Update -->
                    <script>
                        document.querySelectorAll('.btnEdit').forEach(btn => {
                            btn.addEventListener('click', function() {
                                document.getElementById('modalTitle').innerText = 'Edit Category';
                                document.getElementById('action').value = 'update';

                                document.getElementById('category_id').value = this.dataset.id;
                                document.getElementById('category_name').value = this.dataset.name;
                            });
                        });

                        document.querySelectorAll('.btnDelete').forEach(btn => {
                            btn.addEventListener('click', function() {
                                document.getElementById('deleteModalTitle').innerText = 'Delete Category';

                                document.getElementById('delete_category_id').value = this.dataset.id;
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