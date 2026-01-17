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
                        <a href="products.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                            <i
                                class="fas fa-back fa-sm text-white-50"></i> Kembali
                        </a>
                    </div>

                    <div id="result"></div>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form tambah <?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <form id="formProduct" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_pict" class="form-label">Product Pict <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="product_pict" name="product_pict" required>
                                    <img id="preview" src="#" style="display:none; width:150px; margin-top:10px;">
                                </div>
                                <div class="mb-3">
                                    <label for="product_description" class="form-label">Product Description <span class="text-danger">*</span></label>
                                    <textarea name="product_description" id="product_description" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="product_category" class="form-label">Product Category <span class="text-danger">*</span></label>
                                    <select name="product_category" id="product_category" class="form-control" required>
                                        <option value="" selected>Pilih Kategori</option>
                                        <?php
                                        $rows = read();

                                        foreach ($rows as $row) { ?>
                                            <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="product_sub_category" class="form-label">Product Sub Category</label>
                                    <select name="product_sub_category" id="product_sub_category" class="form-control">
                                        <option value="" selected>Pilih Sub Kategori</option>
                                        <?php
                                        $rows = read();

                                        foreach ($rows as $row) { ?>
                                            <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Product Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="product_stock" class="form-label">Product Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="product_stock" name="product_stock" required>
                                </div>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>



                    <script>
                        document.getElementById("product_pict").addEventListener("change", function() {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById("preview");
                                    img.src = e.target.result;
                                    img.style.display = "block";
                                }
                                reader.readAsDataURL(file);
                            }
                        });

                        document.getElementById("formProduct").addEventListener("submit", function(e) {
                            e.preventDefault();

                            let formData = new FormData(this);

                            fetch("./api/products/create.php", {
                                    method: "POST",
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(result => {
                                    document.getElementById("result").innerHTML = `
                                        <div class="alert alert-${result.status ? 'success':'danger'}">
                                            ${result.message}
                                        </div>
                                    `;

                                    if (result.status) {
                                        this.reset();
                                        alert(result.message);
                                        // delay 1 detik lalu redirect
                                        setTimeout(() => {
                                            window.location.href = "products.php";
                                        }, 1000);
                                    }
                                })
                                .catch(err => console.error(err));
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