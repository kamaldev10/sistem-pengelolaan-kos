<?php
include 'header.php';
include "config.php";

if (!isset($_GET['id'])) {
    header("Location: kamar.php");
}
$id = $_GET['id'];
$e = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar=$id"));

if (isset($_POST['update'])) {
    $no_kamar = $_POST['no_kamar'];
    $status   = $_POST['status'];
    $harga    = $_POST['harga'];
    mysqli_query($koneksi, "UPDATE kamar SET no_kamar='$no_kamar', status='$status', harga='$harga' WHERE id_kamar=$id");
    header("Location: kamar.php");
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-dark text-center rounded-top-4">
          <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Kamar</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label fw-semibold">No Kamar</label>
              <input type="text" name="no_kamar" class="form-control" value="<?= $e['no_kamar'] ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Status</label>
              <select name="status" class="form-select">
                <option value="kosong" <?= $e['status'] == 'kosong' ? 'selected' : '' ?>>Kosong</option>
                <option value="terisi" <?= $e['status'] == 'terisi' ? 'selected' : '' ?>>Terisi</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Harga</label>
              <input type="number" name="harga" class="form-control" value="<?= $e['harga'] ?>" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="kamar.php" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left"></i> Kembali
              </a>
              <button type="submit" name="update" class="btn btn-warning text-dark px-4">
                <i class="bi bi-save"></i> Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
