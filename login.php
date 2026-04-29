<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoJadwalKu - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
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

           <form class="login-form" method="POST">
                <div class="input-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="Masukkan Email Siswa" required>
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>
                
                <button type="submit" class="btn-login">Masuk Sekarang</button>
            </form>

            <?php
            session_start();
            include 'config.php'; // Pastikan file ini ada (yang kita buat di awal)

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $pass = $_POST['password'];

                $query = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    // SIMPAN IDENTITAS KE SESSION (Kartu Pengenal Ghaib)
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['nama'] = $user['nama'];
                    
                    header("Location: index.html");
                } else {
                    echo "<p style='color:red; text-align:center;'>Email atau Password salah!</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>