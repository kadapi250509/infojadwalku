<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Silakan login dulu!");
}

$user_id = $_SESSION['user_id'];
$target_dir = "uploads/";
$nama_file = time() . "_" . basename($_FILES["foto_profil"]["name"]);
$target_file = $target_dir . $nama_file;

if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
    // UPDATE DATABASE: Masukkan nama file foto ke baris user yang sedang login
    $sql = "UPDATE users SET foto='$nama_file' WHERE id='$user_id'";
    mysqli_query($conn, $sql);
    
    header("Location: profile.php");
}
?>