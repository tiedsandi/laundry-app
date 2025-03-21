<?php
include '../../koneksi.php';

$id = isset($_GET['id_service']) ? $_GET['id_service'] : '';

$query = mysqli_query($conn, "SELECT * FROM type_of_service WHERE id = $id");
$data = mysqli_fetch_assoc($query);

$response = [
    'status' => 'success',
    'message' => 'Data service berhasil diambil',
    'data' => $data,
];

echo json_encode($response);
?>