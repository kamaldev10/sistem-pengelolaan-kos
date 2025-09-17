<?php
include 'header.php';
include 'config.php';

if (isset($_POST['simpan'])) {
    $id_penyewa   = $_POST['id_penyewa'];
    $tgl_bayar    = $_POST['tgl_bayar'];
    $bulan        = $_POST['bulan'];
    $status_bayar = $_POST['status_bayar'];

    mysqli_query($koneksi, "INSERT INTO pembayaran (id_penyewa, tgl_bayar, bulan, status_bayar) 
                            VALUES ('$id_penyewa','$tgl_bayar','$bulan','$status_bayar')");
    header("Location: pembayaran.php");
    exit;
}

// jika ada id_penyewa dari add_penyewa
$id_penyewa_auto = $_GET['id_penyewa'] ?? '';
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
          <h3 class="mb-0"><i class="bi bi-cash-coin"></i> Tambah Pembayaran</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label fw-semibold">Penyewa</label>
              <select name="id_penyewa" class="form-select" required>
                <option value="">-- Pilih Penyewa --</option>
                <?php
                $penyewa = mysqli_query($koneksi, "SELECT * FROM penyewa");
while ($p = mysqli_fetch_assoc($penyewa)) {
    $selected = ($id_penyewa_auto == $p['id_penyewa']) ? 'selected' : '';
    echo "<option value='{$p['id_penyewa']}' $selected>{$p['nama']} ({$p['kontak']})</option>";
}
?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Bayar</label>
              <input type="date" name="tgl_bayar" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Bulan</label>
              <input type="text" name="bulan" class="form-control" placeholder="Contoh: September 2025" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Status Bayar</label>
              <select name="status_bayar" class="form-select">
                <option value="lunas">Lunas</option>
                <option value="belum">Belum</option>
              </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="pembayaran.php" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left"></i> Kembali
              </a>
              <button type="submit" name="simpan" class="btn btn-success px-4">
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
