<?php include 'header.php'; ?>
<?php include 'config.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-white">Data Pelanggan</h2>
        <a href="add_penyewa.php" class="btn btn-info">
            <i class="bi bi-plus-circle"></i> Tambah pelanggan
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <tr class="table-dark text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Tgl Masuk</th>
            <th>Kamar</th>
            <th>Aksi</th>
        </tr>
        <?php
        $q = $koneksi->query("SELECT penyewa.*, kamar.no_kamar 
                              FROM penyewa 
                              LEFT JOIN kamar ON penyewa.id_kamar=kamar.id_kamar");
$no = 1;
while ($row = $q->fetch_assoc()) {
    echo "
            <tr class='table-light'>
              <td class='text-center'>{$no}</td>
              <td>{$row['nama']}</td>
              <td>{$row['kontak']}</td>
              <td>{$row['tgl_masuk']}</td>
              <td class='text-center'>{$row['no_kamar']}</td>
              <td class='text-center'>
                <a href='edit_penyewa.php?id={$row['id_penyewa']}' class='btn btn-warning btn-sm'>
                    <i class='bi bi-pencil-square'></i>
                </a>
                <button class='btn btn-danger btn-sm btn-delete' 
                        data-id='{$row['id_penyewa']}' 
                        data-nama='{$row['nama']}' 
                        data-bs-toggle='modal' 
                        data-bs-target='#deleteModal'>
                    <i class='bi bi-trash'></i>
                </button>
              </td>
            </tr>";
    $no++;
}
?>
    </table>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus <strong id="namaPenyewa"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="btnConfirmDelete" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script>
  const deleteButtons = document.querySelectorAll('.btn-delete');
  const namaPenyewa = document.getElementById('namaPenyewa');
  const btnConfirmDelete = document.getElementById('btnConfirmDelete');

  deleteButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      const nama = btn.getAttribute('data-nama');

      namaPenyewa.textContent = nama;
      btnConfirmDelete.href = 'delete_penyewa.php?id=' + id;
    });
  });
</script>

<?php include 'footer.php'; ?>
