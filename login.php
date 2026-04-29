<?php
// 1. Memulai session (Wajib di baris paling atas)
session_start();

// 2. Menyambungkan ke database
include 'config.php';

// Cek jika user sudah login, langsung lempar ke beranda
if (isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Sesuaikan jika berandamu .php
    exit();
}

$error_message = "";

// 3. Proses saat tombol login ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Mencari user di database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (disini kita pakai cek teks biasa dulu sesuai insert sebelumnya)
        if ($password == $user['password']) {
            // LOGIN BERHASIL
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['email']   = $user['email'];

            header("Location: index.html"); // Pindah ke beranda
            exit();
        } else {
            $error_message = "Password salah!";
        }
    } else {
        $error_message = "Email tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoJadwalKu - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="mobile-app login-screen">
        <div class="login-content">
            <div class="logo-container">
                <i class="fa-regular fa-calendar-check logo-icon"></i>
            </div>
            
            <h1 class="app-title">InfoJadwalKu</h1>
            <p class="app-subtitle">Kelola Jadwalmu Lebih Cerdas & Mudah</p>

            <?php if ($error_message): ?>
                <div style="color: #E53E3E; background: #FED7D7; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; text-align: center;">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form class="login-form" method="POST" action="login.php">
                <div class="input-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="Masukkan Email Siswa" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                
                <button type="submit" class="btn-login">Masuk Sekarang</button>
                
                <div class="divider"><span>ATAU</span></div>
                
                <button type="button" class="btn-google">
                    <i class="fa-brands fa-google"></i> Masuk dengan Google
                </button>
            </form>
        </div>
    </div>
</body>
</html>