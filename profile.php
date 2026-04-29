<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="mobile-app">
        <header class="chat-header">
            <a href="index.html" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Profil</h2>
            <i class="fa-solid fa-gear"></i>
        </header>

        <div style="text-align: center; padding: 40px 20px;">
            
            <?php
            // Logika untuk mencari foto profil terbaru yang di-upload
            $directory = "uploads/";
            $latest_image = "";
            
            // Mengecek apakah folder uploads ada dan mencari file gambar di dalamnya
            if (file_exists($directory)) {
                $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                if (!empty($images)) {
                    // Mengurutkan agar foto yang paling baru di-upload berada di urutan pertama
                    array_multisort(array_map('filemtime', $images), SORT_DESC, $images);
                    $latest_image = $images[0]; 
                }
            }
            ?>

            <?php if (!empty($latest_image)): ?>
                <img id="fotoProfil" src="<?php echo $latest_image; ?>" style="width: 128px; height: 128px; border-radius: 50%; border: 4px solid white; box-shadow: 0 10px 20px rgba(0,0,0,0.1); object-fit: cover;">
            <?php else: ?>
                <img id="fotoProfil" src="https://ui-avatars.com/api/?name=User&background=random&size=128" style="border-radius: 50%; border: 4px solid white; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            <?php endif; ?>
            
            <form action="upload_foto.php" method="POST" enctype="multipart/form-data" style="margin-top: 15px;">
                <input type="file" name="foto_profil" accept="image/*" required style="margin-bottom: 10px; font-size: 12px;">
                <br>
                <button type="submit" style="background-color: #4CAF50; color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">
                    Upload Foto
                </button>
            </form>

            <h2 id="namaProfil" style="margin-top: 25px;">Nama Siswa</h2>
            <p style="color: #718096;">Siswa - XI TKJ 1</p>
            
            <div style="margin-top: 30px; text-align: left; background: white; border-radius: 15px; padding: 20px;">
                <div style="margin-bottom: 15px;">
                    <label style="font-size: 0.7rem; color: #A0AEC0; font-weight: bold;">NISN</label>
                    <p style="font-weight: 500;">0012345678</p>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="font-size: 0.7rem; color: #A0AEC0; font-weight: bold;">EMAIL</label>
                    <p id="emailProfil" style="font-weight: 500;">email@sekolah.sch.id</p>
                </div>
            </div>

            <button style="width: 100%; margin-top: 20px; background: #E53E3E; color: white; border: none; padding: 15px; border-radius: 12px; font-weight: 600;">Keluar Aplikasi</button>
        </div>
    </div>
</body>
</html>