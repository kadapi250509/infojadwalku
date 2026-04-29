document.addEventListener('DOMContentLoaded', () => {

    // --- 0. SATPAM PENJAGA (CEK LOGIN) ---
    // --- 0.5 TAMPILKAN NAMA USER DINAMIS ---
    const savedName = localStorage.getItem('userName');
    const savedEmail = localStorage.getItem('userEmail');

    if (savedName) {
        // Ganti sapaan di Beranda (index.html)
        const greetingEl = document.querySelector('.greeting');
        const avatarBeranda = document.querySelector('.avatar');
        if (greetingEl) greetingEl.innerText = `Halo, ${savedName}!`;
        if (avatarBeranda) avatarBeranda.src = `https://ui-avatars.com/api/?name=${savedName}&background=random`;

        // Ganti info di Halaman Profil (profile.html)
        const namaProfil = document.getElementById('namaProfil');
        const emailProfil = document.getElementById('emailProfil');
        const fotoProfil = document.getElementById('fotoProfil');
        
        if (namaProfil) namaProfil.innerText = savedName;
        if (emailProfil) emailProfil.innerText = savedEmail;
        if (fotoProfil) fotoProfil.src = `https://ui-avatars.com/api/?name=${savedName}&background=random&size=128`;
    }
    // Cek apakah ada data 'isLoggedIn' di memori browser
    const sudahLogin = localStorage.getItem('isLoggedIn');
    
    // Jika belum login, langsung tendang ke halaman login.html
    if (!sudahLogin) {
        window.location.href = 'login.html';
        return; // Hentikan proses pembacaan kode di bawahnya
    }


    // ... dan seterusnya ...
    // --- 1. LOGIKA KALENDER DINAMIS ---
    const calendarDays = document.getElementById('calendar-days');
    const judulBulanTahun = document.getElementById('bulan-tahun');
    const panahKiri = document.getElementById('panah-kiri');
    const panahKanan = document.getElementById('panah-kanan');

    // Daftar nama bulan
    const namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    
    // Setel waktu awal (Bulan saat ini, atau kita mulai di Oktober 2026)
    let tanggalSaatIni = new Date(2026, 9, 1); // Angka 9 artinya Oktober (karena dihitung dari 0 = Januari)

    function renderKalender() {
        if (!calendarDays) return; // Mencegah error jika bukan di halaman Beranda

        // Kosongkan kalender lama sebelum membuat yang baru
        calendarDays.innerHTML = ''; 

        // Ambil info tahun dan bulan dari mesin waktu JS
        const tahun = tanggalSaatIni.getFullYear();
        const bulan = tanggalSaatIni.getMonth();

        // Ubah teks judul (Contoh: "November 2026")
        if (judulBulanTahun) {
            judulBulanTahun.innerText = `${namaBulan[bulan]} ${tahun}`;
        }

        // Cari tahu: Bulan ini ada berapa hari? (Tanggal 0 bulan depan = hari terakhir bulan ini)
        const jumlahHari = new Date(tahun, bulan + 1, 0).getDate();
        
        // Cari tahu: Tanggal 1 jatuh pada hari apa? (0 = Minggu, 1 = Senin, dst)
        const hariPertama = new Date(tahun, bulan, 1).getDay();

        // 1. Buat kotak kosong untuk menggeser tanggal 1 agar pas dengan harinya
        for (let i = 0; i < hariPertama; i++) {
            const kotakKosong = document.createElement('div');
            calendarDays.appendChild(kotakKosong);
        }

        // 2. Tulis angka tanggal dari 1 sampai habis
        for (let i = 1; i <= jumlahHari; i++) {
            const kotakTanggal = document.createElement('div');
            kotakTanggal.classList.add('date-num');
            kotakTanggal.innerHTML = `<span>${i}</span>`;

            // Simulasi titik jadwal (hanya muncul acak untuk hiasan)
            if ([12, 16, 20].includes(i)) {
                const dot = document.createElement('div');
                dot.classList.add('dot', 'green');
                kotakTanggal.appendChild(dot);
            }

            // EVENT KLIK TANGGAL
            kotakTanggal.addEventListener('click', () => {
                document.querySelectorAll('.date-num').forEach(el => el.classList.remove('active'));
                kotakTanggal.classList.add('active');
                
                // Animasi kecil pada jadwal di bawah (opsional, agar terasa hidup)
                document.querySelector('.agenda-section').style.opacity = '0.5';
                setTimeout(() => { document.querySelector('.agenda-section').style.opacity = '1'; }, 200);
            });

            calendarDays.appendChild(kotakTanggal);
        }
    }

    // Jalankan kalender pertama kali saat web dibuka
    renderKalender();

    // LOGIKA KLIK PANAH
    if (panahKiri && panahKanan) {
        panahKiri.addEventListener('click', () => {
            // Mundurkan bulan - 1
            tanggalSaatIni.setMonth(tanggalSaatIni.getMonth() - 1);
            renderKalender();
        });

        panahKanan.addEventListener('click', () => {
            // Majukan bulan + 1
            tanggalSaatIni.setMonth(tanggalSaatIni.getMonth() + 1);
            renderKalender();
        });
    }


    // --- 2. LOGIKA KLIK JADWAL (AGENDA) - Tetap sama seperti sebelumnya ---
    const agendaCards = document.querySelectorAll('.agenda-card');
    agendaCards.forEach(card => {
        card.style.cursor = "pointer";
        card.addEventListener('click', () => {
            const judul = card.querySelector('.subject-name').innerText;
            alert("Membuka detail mata pelajaran: " + judul);
        });
    });

    // --- 3. LOGIKA KLIK PROFIL - Tetap sama seperti sebelumnya ---
    const profileSection = document.querySelector('.user-info');
    if (profileSection) {
        profileSection.style.cursor = "pointer";
        profileSection.addEventListener('click', () => {
            window.location.href = 'profile.html';
        });
    }
});