<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>SB Admin 2 - Dashboard</title>

<!-- Custom fonts for this template-->
<link href="./../assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="./../assets/backend/css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="./../assets/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="./../assets/backend/vendor/jquery/jquery.min.js" defer></script>
<script src="./../assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>

<!-- Core plugin JavaScript-->
<script src="./../assets/backend/vendor/jquery-easing/jquery.easing.min.js" defer></script>

<!-- Custom scripts for all pages-->
<script src="./../assets/backend/js/sb-admin-2.min.js" defer></script>

<!-- Page level plugins -->
<script src="./../assets/backend/vendor/chart.js/Chart.min.js" defer></script>

<!-- Page level custom scripts -->
<script src="./../assets/backend/js/demo/chart-area-demo.js" defer></script>
<script src="./../assets/backend/js/demo/chart-pie-demo.js" defer></script>

<!-- Page level plugins -->
<script src="./../assets/backend/vendor/datatables/jquery.dataTables.min.js" defer></script>
<script src="./../assets/backend/vendor/datatables/dataTables.bootstrap4.min.js" defer></script>

<!-- Page level custom scripts -->
<script src="./../assets/backend/js/demo/datatables-demo.js" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";

                // Hapus elemen setelah animasi selesai
                setTimeout(() => alert.remove(), 500);
            }, 5000); // 5 detik
        });
    });
</script>