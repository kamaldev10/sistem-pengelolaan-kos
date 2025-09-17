<?php
include 'header.php';
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: pembayaran.php");
}
$id = $_GET['id'];
$e = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_bayar=$id"));

if (isset($_POST['update'])) {
    $id_penyewa   = $_POST['id_penyewa'];
    $tgl_bayar    = $_POST['tgl_bayar'];
    $bulan        = $_POST['bulan'];
    $status_bayar = $_POST['status_bayar'];

    mysqli_query($koneksi, "UPDATE pembayaran SET 
                            id_penyewa='$id_penyewa',
                            tgl_bayar='$tgl_bayar',
                            bulan='$bulan',
                            status_bayar='$status_bayar'
                            WHERE id_bayar=$id");
    header("Location: pembayaran.php");
}
?>

<div class="container py-4">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-warning text-dark">
      <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Pembayaran</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label fw-semibold">Penyewa</label>
          <select name="id_penyewa" class="form-control" required>
            <?php
            $penyewa = mysqli_query($koneksi, "SELECT * FROM penyewa");
while ($p = mysqli_fetch_assoc($penyewa)) {
    $selected = $p['id_penyewa'] == $e['id_penyewa'] ? 'selected' : '';
    echo "<option value='{$p['id_penyewa']}' $selected>{$p['nama']} ({$p['kontak']})</option>";
}
?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Tanggal Bayar</label>
          <input type="date" name="tgl_bayar" class="form-control" value="<?= $e['tgl_bayar'] ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Bulan</label>
          <input type="text" name="bulan" class="form-control" value="<?= $e['bulan'] ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Status Bayar</label>
          <select name="status_bayar" class="form-control">
            <option value="lunas" <?= $e['status_bayar'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
            <option value="belum" <?= $e['status_bayar'] == 'belum' ? 'selected' : '' ?>>Belum</option>
          </select>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="pembayaran.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
