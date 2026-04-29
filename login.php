<?php
// 1. WAJIB: Memulai sesi di baris paling atas
session_start();

// 2. WAJIB: Menyambungkan ke database
// Pastikan kamu punya file config.php yang isinya benar
include 'config.php';

// Jika user ternyata sudah login, langsung lempar ke beranda
if (isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$error = "";

// 3. Proses saat tombol "Masuk Sekarang" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Mencari user berdasarkan email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Cek apakah password cocok
        if ($password == $row['password']) {
            // BERHASIL LOGIN! Simpan data ke Sesi (Session)
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];

            // Pindah ke halaman utama
            header("Location: index.html");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak terdaftar!";
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

            <div class="login-form">
                <form action="login.php" method="POST">
                    
                    <?php if($error != ""): ?>
                        <div style="color: white; background: #E53E3E; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.9rem; text-align: center;">
                            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

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
    </div>

</body>
</html>