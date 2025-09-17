<?php

include "config.php";
$id = $_GET['id'];

$res = $koneksi->query("SELECT id_kamar FROM penyewa WHERE id_penyewa=$id");
$id_kamar = $res->fetch_assoc()['id_kamar'];

$koneksi->query("DELETE FROM penyewa WHERE id_penyewa=$id");
$koneksi->query("UPDATE kamar SET status='kosong' WHERE id_kamar='$id_kamar'");

header("Location: penyewa.php");
