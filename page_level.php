<?php
    require 'koneksi.php';
    include 'inc/middleware.php'; 
    checkRole(['Administrator']);

    // get data table
    $levelQuery = mysqli_query($conn, "
                    SELECT * FROM level 
                    ORDER BY 
                        (deleted_at IS NOT NULL AND deleted_at != '0000-00-00 00:00:00') ASC,
                        id DESC,
                        level_name ASC
                ");

    $rows = mysqli_fetch_all($levelQuery, MYSQLI_ASSOC);

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $currentTime = date('Y-m-d H:i:s', strtotime('+6 hours')); 
    
        $query = "UPDATE level SET deleted_at = '$currentTime' WHERE id = $id";
        mysqli_query($conn, $query);
    
        header("Location: page_level.php?message=deleted");
        exit();
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Level role</title>
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
            <h1>Level (role)</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                   
                        <div class="card-body">
                            <?php if (isset($_GET['kirim']) && $_GET['kirim'] == "sukses") { ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    Anda Berhasil tambah level!
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET['message']) && $_GET['message'] == "deleted") { ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    Data berhasil delete
                                </div>
                            <?php } ?>
                            <div class="d-flex justify-content-between align-items-center py-4">
                                <h5 class="card-title">Tabel Level</h5>
                                <a href="add_edit_level.php" class="btn btn-primary">Tambah Level</a>
                            </div>

                            <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Level</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rows as $row) {
                                        ?>

                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $row['level_name'] ?></td>
                                                <td><?php echo ($row['deleted_at'] == '0000-00-00 00:00:00' || empty($row['deleted_at'])) ? "Active" : "Inactive"; ?></td>

                                                
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="add_edit_level.php?idEdit=<?php echo $row['id'] ?>">Edit</a>
                                                    <?php if($row['deleted_at'] == '0000-00-00 00:00:00' || empty($row['deleted_at'])) :?>
                                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin delete ?')" href="page_level.php?delete=<?php echo $row['id'] ?>">Delete</a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                        <!-- cek jika data kosong -->
                                        <?php if (empty($rows)) : ?>
                                            <tr>
                                                <td colspan="6">Belum ada data</td>
                                            </tr>
                                        <?php endif ?> 
                                     

                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
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
 

</body>

</html>