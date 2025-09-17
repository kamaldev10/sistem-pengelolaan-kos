<?php

include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_bayar=$id");
}
header("Location: pembayaran.php");
