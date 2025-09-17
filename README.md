# 🏠 Sistem Manajemen Kos

Aplikasi berbasis web sederhana untuk membantu pengelola kos dalam mengelola data kamar, penyewa, dan pembayaran bulanan.  
Dibuat dengan **PHP + MySQL + Bootstrap** agar mudah digunakan dan di-deploy di shared hosting maupun server lokal (XAMPP/Laragon).

---

## ✨ Fitur Utama

- **Manajemen Kamar**
  - Tambah, edit, hapus kamar
  - Status kamar (kosong/terisi) otomatis terupdate saat penyewa masuk/keluar
- **Manajemen Penyewa**
  - Tambah, edit, hapus penyewa
  - Hubungkan penyewa dengan kamar
  - Modal konfirmasi untuk hapus data
- **Manajemen Pembayaran**
  - Tambah, edit, hapus pembayaran
  - Lihat daftar pembayaran terbaru
  - Statistik jumlah pembayaran bulan ini
- **Dashboard**
  - Ringkasan jumlah kamar, penyewa, dan pembayaran
  - Aktivitas terbaru (log pembayaran)
  - CTA (Quick Action) untuk tambah data baru

---

## 📂 Struktur Folder

```json
project-root/
├── add_kamar.php
├── edit_kamar.php
├── delete_kamar.php
├── kamar.php
│
├── add_penyewa.php
├── edit_penyewa.php
├── delete_penyewa.php
├── penyewa.php
│
├── add_pembayaran.php
├── edit_pembayaran.php
├── delete_pembayaran.php
├── pembayaran.php
│
├── config.php # Koneksi database
├── header.php # Header + Bootstrap
├── footer.php # Footer
└── index.php # Dashboard utama
```

---

## ⚙️ Instalasi

1. Clone/download repository ini.
2. Simpan project ke folder `htdocs` (XAMPP) atau `www` (Laragon).
3. Import file database `kos_db.sql` ke MySQL (buat database `kos_kos` misalnya).
4. Ubah konfigurasi koneksi di `config.php` sesuai server lokal Anda:
   ```php
   $koneksi = mysqli_connect("localhost", "root", "", "kos_db");
   ```
5. jalankan di browser

```json
   http://localhost/nama-folder-project
```
