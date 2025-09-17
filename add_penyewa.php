<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $id_kamar = $_POST['id_kamar'];

    // insert penyewa
    $koneksi->query("INSERT INTO penyewa (nama, kontak, tgl_masuk, id_kamar)
                     VALUES ('$nama','$kontak','$tgl_masuk','$id_kamar')");

    // ambil id penyewa terakhir
    $id_penyewa = $koneksi->insert_id;

    // update status kamar
    $koneksi->query("UPDATE kamar SET status='terisi' WHERE id_kamar='$id_kamar'");

    // redirect langsung ke add_pembayaran dengan membawa id_penyewa
    header("Location: add_pembayaran.php?id_penyewa=$id_penyewa");
    exit;
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
          <h3 class="mb-0">Tambah Pelanggan Baru</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form method="post">
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Lengkap</label>
              <input type="text" name="nama" placeholder="Masukkan nama penyewa" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Kontak</label>
              <input type="text" name="kontak" placeholder="Nomor HP / WhatsApp" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Masuk</label>
              <input type="date" name="tgl_masuk" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Kamar</label>
              <select name="id_kamar" class="form-select" required>
                <option value="">-- Pilih Kamar --</option>
                <?php
                $q = $koneksi->query("SELECT * FROM kamar WHERE status='kosong'");
while ($row = $q->fetch_assoc()) {
    echo "<option value='{$row['id_kamar']}'>No: {$row['no_kamar']} - Rp" . number_format($row['harga'], 0, ',', '.') . "</option>";
}
?>
              </select>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="penyewa.php" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left"></i> Kembali
              </a>
              <button type="submit" name="simpan" class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
