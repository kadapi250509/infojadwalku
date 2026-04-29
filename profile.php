<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

// Jika tidak ada session (belum login), tendang ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data user dari database
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="mobile-app">
        <div style="text-align: center; padding: 40px 20px;">
            
            <?php 
            $foto_nama = $user['foto']; 
            $path_foto = "uploads/" . $foto_nama;

            if (!empty($foto_nama) && file_exists($path_foto)): ?>
                <img src="<?php echo $path_foto; ?>" style="width: 128px; height: 128px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            <?php else: ?>
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama']); ?>&background=random&size=128" style="border-radius: 50%; border: 4px solid white;">
            <?php endif; ?>

            <h2 style="margin-top: 15px;"><?php echo $user['nama']; ?></h2>
            <p style="color: #718096;"><?php echo $user['email']; ?></p>

            <form action="upload_foto.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                <input type="file" name="foto_profil" accept="image/*" required>
                <button type="submit" style="background: #4CAF50; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Ganti Foto</button>
            </form>

            <a href="logout.php" style="display: block; margin-top: 20px; color: #E53E3E; text-decoration: none; font-weight: bold;">Keluar Aplikasi</a>
        </div>
    </div>
</body>
</html>