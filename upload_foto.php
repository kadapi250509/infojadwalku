<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak!");
}

$user_id = $_SESSION['user_id'];
$target_dir = "uploads/";

// Memberi nama unik agar tidak bentrok dengan foto orang lain
$file_extension = pathinfo($_FILES["foto_profil"]["name"], PATHINFO_EXTENSION);
$new_filename = "user_" . $user_id . "_" . time() . "." . $file_extension;
$target_file = $target_dir . $new_filename;

if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
    // Simpan nama file baru ke kolom 'foto' di tabel users
    $update = mysqli_query($conn, "UPDATE users SET foto = '$new_filename' WHERE id = '$user_id'");
    
    if ($update) {
        header("Location: profile.php?status=success");
    } else {
        echo "Gagal update database!";
    }
} else {
    echo "Gagal upload file ke server! Cek izin folder uploads.";
}
?>