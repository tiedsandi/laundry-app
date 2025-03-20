<?php
    require 'koneksi.php';
    include 'inc/middleware.php';
    checkRole(['Administrator']);

    // get data table
    $typeQuery = mysqli_query($conn, "
                    SELECT * FROM type_of_service 
                    ORDER BY 
                        (deleted_at IS NOT NULL AND deleted_at != '0000-00-00 00:00:00') ASC,
                        id DESC,
                        service_name ASC
                ");

    $rows = mysqli_fetch_all($typeQuery, MYSQLI_ASSOC);

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $currentTime = date('Y-m-d H:i:s', strtotime('+6 hours'));  
    
        $query = "UPDATE type_of_service SET deleted_at = '$currentTime' WHERE id = $id";
        mysqli_query($conn, $query);
    
        header("Location: page_type-services.php?message=deleted");
        exit();
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tipe Service</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">  
            <nav class="nav mb-4 d-flex  gap-4">
                <a class="btn 
                    <?= (empty($_GET['page']) || $_GET['page'] === "trans-laundry") ? "btn-primary" : "btn-secondary"?> btn-primary" href="page_transaksi.php?page=trans-laundry">
                    Transaksi Laundry
                </a>
                <a class="btn 
                    <?= (isset($_GET['page']) && $_GET['page'] === "trans-pengembalian") ? "btn-primary" : "btn-secondary"?>" href="page_transaksi.php?page=trans-pengembalian">
                    Transaksi Pengembalian
                </a>
            </nav>


            <h1>
                <?= (isset($_GET['page']) && $_GET['page']=== 'trans-laundry' || empty($_GET['page'])) ? "Transaksi Laundry" : "Transaksi Pengembalian" ?>
            </h1>
        </div>

        <section class="section">
            <?php 
                if(isset($_GET['page']) && file_exists('inc/content/'. $_GET['page'] .'.php')) {
                    include 'inc/content/'. $_GET['page'] .'.php';
                }else {
                    include'inc/content/trans-laundry.php';
                }
            ?>
        </section>

    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script>
        $('.add-row') .click(function() {
        alert('testing');
        });
    </script>

</body>

</html>