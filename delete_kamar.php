<?php

include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar=$id");
}
header("Location: kamar.php");
