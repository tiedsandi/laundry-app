<?php
session_start();
// middleware
if (empty($_SESSION['role']) || empty($_SESSION['nama']) ) {
    header("location: login.php");
}


function checkRole($allowedRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        header("location: index.php");
        exit();
    }
}