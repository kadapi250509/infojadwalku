<?php
// Mengaktifkan laporan error agar mudah mencari kalau ada salah
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tentukan folder tujuan (harus sama dengan yang dibuat di server CentOS)
$target_dir = "uploads/";

// Mengambil file yang dikirim dari form
if (isset($_FILES["foto_profil"])) {
    $nama_file = basename($_FILES["foto_profil"]["name"]);
    
    // Menambahkan angka acak di depan nama file agar tidak bentrok jika namanya sama
    $target_file = $target_dir . time() . "_" . $nama_file; 

    // Mencoba memindahkan file ke folder uploads
    if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
        echo "<h2>🎉 Hore! Foto berhasil di-upload ke server!</h2>";
        echo "File tersimpan dengan nama: " . $target_file . "<br><br>";
        
        // Catatan: Tombol ini asumsikan nama file profilmu adalah profil.html atau index.html, 
        // silakan ganti jika namanya berbeda
        echo "<a href='javascript:history.back()'><button>Kembali ke Profil</button></a>";
    } else {
        echo "<h2>Yah, foto gagal di-upload. Pastikan folder uploads sudah memiliki izin.</h2>";
    }
} else {
    echo "Tidak ada file yang dikirim.";
}
?>