<?php
require_once "koneksi.php";
include 'inc/middleware.php'; 
checkRole(['Administrator']);

$queryLevel = mysqli_query($conn, "SELECT * FROM level 
                    WHERE deleted_at IS NULL OR deleted_at = '0000-00-00 00:00:00' 
                    ORDER BY level_name ASC");
$rowLevel = mysqli_fetch_all($queryLevel, MYSQLI_ASSOC);

if(isset($_POST['tambah'])){
    $id_level = $_POST['id_level'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // cek if null datanya
    if (empty($id_level) || empty($name) || empty($email) || empty($password)) {
        header("Location: add_edit_user.php?tambah=error");
        exit();
    }

    $insert = mysqli_query($conn, "INSERT INTO user 
            (id_level, name, email, password) 
            VALUES ('$id_level','$name','$email','$password')");
    
    if ($insert) {
        header("Location: page_user.php?kirim=sukses");
    } else {
        header("Location: add_edit_user.php?tambah=error");
    }
}

if (isset($_GET['idEdit'])) {
    $id = $_GET['idEdit'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($query);
}

if(isset($_POST['edit'])){
    $id_level = $_POST['id_level'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!$password){
        $password = $row['password'];
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // cek if null datanya
    if (empty($id_level) || empty($name) || empty($email) || empty($password)) {
        $idEdit = $_GET['idEdit'] ?? $_POST['idEdit'] ?? 0; 
        header("Location: add_edit_user.php?tambah=error&idEdit=$idEdit");
        exit();
    }

    $update = mysqli_query($conn, "UPDATE user 
            SET id_level = '$id_level', name = '$name', email = '$email', password = '$password'  
            WHERE id = $id");
    
    if ($update) {
        header("Location: page_user.php?kirim=sukses");
    } else {
        header("Location: add_edit_user.php?tambah=error");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo isset($_GET['edit']) ? 'EDIT' : 'ADD' ?> User</title>
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

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

</head>

<body>
    <?php include 'inc/navbar.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <?php if (isset($_GET['tambah']) && $_GET['tambah'] == "error") { ?>
                        <div class="alert alert-danger" role="alert">
                            Anda belum mengisi semua field
                        </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'EDIT' : 'ADD' ?> User</h5>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Level*</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select name="id_level" class="form-control">
                                            <option value="">Pilih Level</option>
                                            <?php foreach($rowLevel as $rowL) :?>
                                                <option 
                                                    value=<?= $rowL['id']?>
                                                    <?php echo isset($row['id_level']) && $row['id_level'] == $rowL['id'] ? 'selected' : ''; ?>
                                                    >
                                                    <?= $rowL['level_name']?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Nama*</label>
                                    </div>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                            name="name"
                                             value="<?php echo isset($_GET['idEdit']) ? $row['name'] : '' ?>"
                                            >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Email*</label>
                                    </div>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control"
                                            name="email"
                                             value="<?php echo isset($_GET['idEdit']) ? $row['email'] : '' ?>"
                                            >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="">Password*</label>
                                    </div>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control"
                                            name="password"
                                            >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <a href="page_user.php" class="btn btn-outline-secondary">Cancel</a>
                                        <?php if(isset($_GET['idEdit'])) :?>
                                            <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                        <?php else :?>
                                            <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
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

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

        


    <script>
      $('.summernote').summernote({
        height: 300,
      });
    </script>

</body>

</html>