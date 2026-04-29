<?php
session_start();
// Jika user belum login, paksa kembali ke login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoJadwalKu - Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="mobile-app">
        
        <header class="header">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Andi&background=random" alt="Profil" class="avatar">
                <div>
                    <h1 class="greeting">Halo, Andi!</h1>
                    <div class="class-dropdown">Kelas XI TKJ 1 <i class="fa-solid fa-chevron-down"></i></div>
                </div>
            </div>
            <div class="notification">
                <i class="fa-regular fa-bell"></i>
                <span class="badge"></span>
            </div>
        </header>

        <section class="calendar-section">
            <div class="calendar-header">
    <h3 id="bulan-tahun">Oktober 2026</h3>
    <div class="nav-arrows">
        <i class="fa-solid fa-chevron-left" id="panah-kiri" style="padding: 10px; cursor: pointer;"></i>
        <i class="fa-solid fa-chevron-right" id="panah-kanan" style="padding: 10px; cursor: pointer;"></i>
    </div>
</div>
            <div class="calendar-grid text-center">
                <div class="day-name">S</div><div class="day-name">S</div><div class="day-name">R</div>
                <div class="day-name">K</div><div class="day-name">J</div><div class="day-name">S</div><div class="day-name">M</div>
                <div id="calendar-days" class="calendar-days"></div>
            </div>
        </section>

        <section class="agenda-section">
            <div class="agenda-title">
                <h3>Jadwal Hari Ini</h3>
                <span>16 Okt</span>
            </div>

            <div class="agenda-card">
                <div class="card-indicator green"></div>
                <div class="card-content">
                    <h4 class="subject-name">Matematika</h4>
                    <p class="time">07:30 - 09:00</p>
                    <div class="details">
                        <span><i class="fa-solid fa-user"></i> Bu Maya</span>
                        <span><i class="fa-solid fa-location-dot"></i> R. Lab 1</span>
                    </div>
                </div>
            </div>

            <div class="agenda-card">
                <div class="card-indicator orange"></div>
                <div class="card-content">
                    <h4 class="subject-name">Ekskul Futsal</h4>
                    <p class="time">15:30 - 17:00</p>
                    <div class="details">
                        <span><i class="fa-solid fa-users"></i> Tim Inti</span>
                        <span><i class="fa-solid fa-location-dot"></i> Lapangan</span>
                    </div>
                </div>
            </div>
        </section>

       <nav class="bottom-nav">
            <a href="index.html" class="nav-item active"><i class="fa-solid fa-house"></i><span>Beranda</span></a>
            <a href="jadwal.html" class="nav-item"><i class="fa-solid fa-list"></i><span>Jadwal</span></a>
            <a href="chat-ai.html" class="nav-item ai-btn"><i class="fa-solid fa-robot"></i><span>Admin AI</span></a>
            <a href="profile.php" class="nav-item"><i class="fa-regular fa-user"></i><span>Profil</span></a>
        </nav>

    </div>

    <script src="script.js"></script>
</body>
</html>