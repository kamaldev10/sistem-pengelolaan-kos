<?php
include 'header.php';
include 'config.php'; // file koneksi database (mysqli_koneksiect)

// Statistik dari database
// Jumlah penyewa
$resPenyewa = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM penyewa");
$jumlahPenyewa = mysqli_fetch_assoc($resPenyewa)['total'];

// Kamar tersedia
$resKamar = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kamar WHERE status='kosong'");
$jumlahKamarKosong = mysqli_fetch_assoc($resKamar)['total'];

// Pembayaran bulan ini (misal ambil bulan berjalan)
$bulanSekarang = date('n'); // 1–12 (misal: 9)
$tahunSekarang = date('Y'); // misal: 2025

$resBayar = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) as total 
     FROM pembayaran 
     WHERE MONTH(tgl_bayar) = '$bulanSekarang' 
       AND YEAR(tgl_bayar) = '$tahunSekarang'
       AND status_bayar = 'lunas'"
);

$jumlahBayar = mysqli_fetch_assoc($resBayar)['total'];

?>
<div class="container py-4">
  <!-- Hero / Welcome -->
  <div class="p-5 mb-4 bg-danger text-white rounded-3 shadow-sm">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Dashboard Utama</h1>
      <p class="col-md-8 fs-4">
        Selamat datang di sistem pengelolaan kos.
        Kelola penyewa, kamar, dan pembayaran dengan cepat & mudah.
      </p>
      <a href="kamar.php" class="btn btn-light btn-lg">Kelola kamar</a>
    </div>
  </div>

  <!-- Statistik singkat -->
  <div class="row text-center mb-5">
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title text-danger">Jumlah Pelanggan</h5>
          <p class="display-6 fw-bold"><?= $jumlahPenyewa; ?></p>
          <a href="penyewa.php" class="btn btn-outline-danger btn-sm">Lihat</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title text-danger">Kamar Tersedia</h5>
          <p class="display-6 fw-bold"><?= $jumlahKamarKosong; ?></p>
          <a href="kamar.php" class="btn btn-outline-danger btn-sm">Kelola</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="card-title text-danger">Pembayaran Bulan Ini</h5>
          <p class="display-6 fw-bold"><?= $jumlahBayar; ?> transaksi</p>
          <a href="pembayaran.php" class="btn btn-outline-danger btn-sm">Detail</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Menu cepat -->
  <section class="mb-5">
    <h2 class="text-center text-danger mb-4">Menu Cepat</h2>
    <div class="row text-center g-4">
      <div class="col-md-4">
        <a href="penyewa.php" class="text-decoration-none">
          <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
              <i class="bi bi-people-fill display-4 text-danger"></i>
              <h5 class="mt-3">Kelola Pelanggan</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="kamar.php" class="text-decoration-none">
          <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
              <i class="bi bi-house-door-fill display-4 text-danger"></i>
              <h5 class="mt-3">Kelola Kamar</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="pembayaran.php" class="text-decoration-none">
          <div class="card shadow-sm h-100 border-0">
            <div class="card-body">
              <i class="bi bi-credit-card-fill display-4 text-danger"></i>
              <h5 class="mt-3">Kelola Pembayaran</h5>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

    <!-- Recent Activity -->
<section class="mb-5">
  <h2 class="text-center text-danger mb-4">Aktivitas Terbaru</h2>
  <ul class="list-group shadow-sm">
    <?php
    $aktivitas = $koneksi->query("
      SELECT p.nama, b.bulan, b.tgl_bayar, k.harga 
      FROM pembayaran b 
      JOIN penyewa p ON p.id_penyewa = b.id_penyewa 
      JOIN kamar k ON p.id_kamar = k.id_kamar 
      ORDER BY b.tgl_bayar DESC LIMIT 5
    ");
if ($aktivitas->num_rows > 0) {
    while ($row = $aktivitas->fetch_assoc()) {
        echo "<li class='list-group-item'>{$row['nama']} membayar bulan {$row['bulan']} sebesar Rp " . number_format($row['harga'], 0, ',', '.') . "</li>";
    }
} else {
    echo "<li class='list-group-item'>Belum ada aktivitas</li>";
}
?>
  </ul>
</section>


  <!-- CTA -->
  <section class="py-5 text-center bg-danger text-white rounded">
    <h2 class="fw-bold">Ingin menambah pelanggan baru?</h2>
    <p class="mb-4">Klik tombol di bawah ini untuk langsung menambahkan data pelanggan ke sistem.</p>
    <a href="penyewa_add.php" class="btn btn-light btn-lg">Tambah Pelanggan</a>
  </section>
</div>
<?php include 'footer.php'; ?>
