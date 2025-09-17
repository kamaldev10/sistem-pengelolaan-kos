<?php
include 'header.php';
include 'config.php';
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-white">Data Pembayaran</h2>
    <a href="add_pembayaran.php" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Tambah Pembayaran
    </a>
  </div>

  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0 align-middle">
          <thead>
            <tr class="table-dark text-center">
              <th>No</th>
              <th>Penyewa</th>
              <th>Tgl Bayar</th>
              <th>Bulan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
$data = mysqli_query($koneksi, "SELECT pembayaran.*, penyewa.nama 
                                            FROM pembayaran 
                                            JOIN penyewa ON pembayaran.id_penyewa=penyewa.id_penyewa
                                            ORDER BY pembayaran.tgl_bayar DESC");
while ($d = mysqli_fetch_assoc($data)) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $d['nama'] ?></td>
                <td class="text-center"><?= $d['tgl_bayar'] ?></td>
                <td><?= $d['bulan'] ?></td>
                <td class="text-center">
                  <span class="badge <?= $d['status_bayar'] == 'lunas' ? 'bg-success' : 'bg-danger' ?>">
                    <?= ucfirst($d['status_bayar']) ?>
                  </span>
                </td>
                <td class="text-center">
                  <a href="edit_pembayaran.php?id=<?= $d['id_bayar'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $d['id_bayar'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>

                <!-- Modal Konfirmasi -->
              <div class="modal fade" id="hapusModal<?= $d['id_bayar'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda yakin ingin menghapus pembayaran oleh <strong> <?= $d['nama'] ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <a href="delete_pembayaran.php?id=<?= $d['id_bayar'] ?>" class="btn btn-danger">
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
