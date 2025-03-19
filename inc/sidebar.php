<?php
$role = $_SESSION['role'];

// Atur akses halaman berdasarkan role
$allowedPages = [
    'Administrator' => ['page_user.php', 'page_level.php', 'page_type-services.php','transaksi-laundry.php','transaksi-pengembalian.php'],
    'Pimpinan' => [''],
    'Operator' => ['transaksi-laundry.php','transaksi-pengembalian.php'],
];

function canAccess($page) {
    global $role, $allowedPages;
    return isset($allowedPages[$role]) && in_array($page, $allowedPages[$role]);
}
?>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Pages</li>

        <?php if (canAccess('page_user.php')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="page_user.php">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (canAccess('transaksi-laundry.php')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="transaksi-laundry.php">
                    <i class="bi bi-person"></i>
                    <span>Transaksi Laundry</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (canAccess('transaksi-pengembalian.php')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="transaksi-pengembalian.php">
                    <i class="bi bi-person"></i>
                    <span>Transaksi Pengembalian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (canAccess('page_level.php')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="page_level.php">
                    <i class="bi bi-person"></i>
                    <span>Level</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (canAccess('page_type-services.php')) : ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="page_type-services.php">
                    <i class="bi bi-person"></i>
                    <span>Tipe Servis</span>
                </a>
            </li>
        <?php endif; ?>

    </ul>
</aside>
