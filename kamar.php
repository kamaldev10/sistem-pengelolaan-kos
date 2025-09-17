<?php
include 'header.php';
include "config.php";
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-white">Data Kamar</h2>
    <a href="add_kamar.php" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Kamar
    </a>
  </div>

  <?php
  $data = mysqli_query($koneksi, "SELECT * FROM kamar");
$no = 1; // mulai nomor dari 1
?>
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0 align-middle">
          <thead>
            <tr class="table-dark text-center">
              <th>No</th>
              <th>No Kamar</th>
              <th>Status</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($d = mysqli_fetch_assoc($data)) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $d['no_kamar'] ?></td>
                <td class="text-center">
                  <span class="badge <?= $d['status'] == 'kosong' ? 'bg-success' : 'bg-danger' ?>">
                    <?= ucfirst($d['status']) ?>
                  </span>
                </td>
                <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                <td class="text-center">
                  <a href='edit_kamar.php?id=<?= $d['id_kamar'] ?>' class='btn btn-sm btn-warning me-1'>
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <!-- Tombol buka modal -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $d['id_kamar'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>

              <!-- Modal Konfirmasi -->
              <div class="modal fade" id="hapusModal<?= $d['id_kamar'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda yakin ingin menghapus kamar <strong>No <?= $d['no_kamar'] ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <a href="delete_kamar.php?id=<?= $d['id_kamar'] ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
