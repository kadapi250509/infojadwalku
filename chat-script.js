document.addEventListener('DOMContentLoaded', () => {
    const chatInput = document.querySelector('.chat-input');
    const sendBtn = document.querySelector('.mic-btn');
    const chatBody = document.querySelector('.chat-body');

    // 1. MENGAMBIL INGATAN CHAT DARI LOCALSTORAGE
    // Jika tidak ada ingatan, buat array kosong []
    let chatHistory = JSON.parse(localStorage.getItem('savedChats')) || [];

    // Fungsi untuk menampilkan chat ke layar
    function renderBubble(text, sender) {
        const bubble = document.createElement('div');
        bubble.classList.add('chat-bubble', sender === 'user' ? 'user-bubble' : 'ai-bubble');
        bubble.innerText = text;
        chatBody.appendChild(bubble);
        chatBody.scrollTop = chatBody.scrollHeight; // Auto scroll ke bawah
    }

    // Tampilkan semua riwayat chat saat halaman dibuka
    chatHistory.forEach(chat => renderBubble(chat.text, chat.sender));

    // 2. FUNGSI MENGIRIM PESAN & MENYIMPAN CHAT
    function handleSend() {
        const message = chatInput.value.trim();
        if (message !== '') {
            // A. Tampilkan pesan user di layar
            renderBubble(message, 'user');
            
            // B. Simpan ke array dan LocalStorage
            chatHistory.push({ text: message, sender: 'user' });
            localStorage.setItem('savedChats', JSON.stringify(chatHistory));
            
            chatInput.value = ''; // Kosongkan kolom ketik

            // C. Simulasi Balasan AI (Jeda 1 detik)
            setTimeout(() => {
                const aiReply = "Sistem AI menerima perintah: '" + message + "'. Jadwal sedang disiapkan di draft bawah.";
                renderBubble(aiReply, 'ai');
                
                // Simpan balasan AI ke memori
                chatHistory.push({ text: aiReply, sender: 'ai' });
                localStorage.setItem('savedChats', JSON.stringify(chatHistory));
            }, 1000);
        }
    }

    // Pemicu tombol kirim (Klik atau Enter)
    sendBtn.addEventListener('click', handleSend);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });

    // 3. FUNGSI MENYIMPAN JADWAL (MENGKLIK "YA, SIMPAN")
    const btnConfirm = document.querySelector('.btn-confirm');
    if (btnConfirm) {
        btnConfirm.addEventListener('click', () => {
            // Mengambil data jadwal dari draft HTML
            const subject = document.querySelector('.draft-card .subject-name').innerText;
            const time = document.querySelector('.draft-card .time').innerText;

            // Simpan jadwal ke LocalStorage
            let savedSchedules = JSON.parse(localStorage.getItem('mySchedules')) || [];
            savedSchedules.push({ subject: subject, time: time });
            localStorage.setItem('mySchedules', JSON.stringify(savedSchedules));

            // Ubah tombol jadi warna hijau sebagai tanda sukses
            btnConfirm.innerText = "Tersimpan ✓";
            btnConfirm.style.backgroundColor = "#48BB78";
            
            // Beritahu pengguna
            alert(`Berhasil! Jadwal ${subject} (${time}) telah ditambahkan ke database (LocalStorage).`);
        });
    }
});