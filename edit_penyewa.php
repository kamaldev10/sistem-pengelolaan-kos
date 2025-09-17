<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<?php
$id = $_GET['id'];
$res = $koneksi->query("SELECT * FROM penyewa WHERE id_penyewa=$id");
$data = $res->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $id_kamar = $_POST['id_kamar'];

    $old = $data['id_kamar'];
    if ($old != $id_kamar) {
        $koneksi->query("UPDATE kamar SET status='kosong' WHERE id_kamar='$old'");
        $koneksi->query("UPDATE kamar SET status='terisi' WHERE id_kamar='$id_kamar'");
    }

    $koneksi->query("UPDATE penyewa SET 
      nama='$nama', kontak='$kontak', tgl_masuk='$tgl_masuk', id_kamar='$id_kamar' 
      WHERE id_penyewa=$id");

    header("Location: penyewa.php");
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-dark text-center rounded-top-4">
          <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Data Pelanggan</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form method="post">
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Lengkap</label>
              <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Kontak</label>
              <input type="text" name="kontak" value="<?= $data['kontak'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Masuk</label>
              <input type="date" name="tgl_masuk" value="<?= $data['tgl_masuk'] ?>" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Kamar</label>
              <select name="id_kamar" class="form-select" required>
                <option value="">-- Pilih Kamar --</option>
                <?php
                $q = $koneksi->query("SELECT * FROM kamar");
while ($row = $q->fetch_assoc()) {
    $selected = ($row['id_kamar'] == $data['id_kamar']) ? "selected" : "";
    echo "<option value='{$row['id_kamar']}' $selected>No: {$row['no_kamar']} - Rp" . number_format($row['harga'], 0, ',', '.') . " ({$row['status']})</option>";
}
?>
              </select>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="penyewa.php" class="btn btn-secondary px-4">
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
