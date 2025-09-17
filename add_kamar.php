<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<?php
if (isset($_POST['simpan'])) {
    $no_kamar = $_POST['no_kamar'];
    $harga = $_POST['harga'];

    $koneksi->query("INSERT INTO kamar (no_kamar, harga, status)
                     VALUES ('$no_kamar','$harga','kosong')");
    header("Location: kamar.php");
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success text-white text-center rounded-top-4">
          <h3 class="mb-0">Tambah Kamar Baru</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form method="post">
            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor Kamar</label>
              <input type="text" name="no_kamar" placeholder="Masukkan nomor kamar" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Harga</label>
              <input type="number" name="harga" placeholder="Masukkan harga kamar" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="kamar.php" class="btn btn-secondary px-4">
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
