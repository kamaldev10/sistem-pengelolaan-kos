CREATE DATABASE kos_db;
USE kos_db;

CREATE TABLE kamar (
  id_kamar INT AUTO_INCREMENT PRIMARY KEY,
  no_kamar VARCHAR(10) NOT NULL,
  status ENUM('kosong','terisi') DEFAULT 'kosong',
  harga DECIMAL(10,2) NOT NULL
);

CREATE TABLE penyewa (
  id_penyewa INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  kontak VARCHAR(20) NOT NULL,
  tgl_masuk DATE NOT NULL,
  id_kamar INT,
  FOREIGN KEY (id_kamar) REFERENCES kamar(id_kamar) ON DELETE SET NULL
);

CREATE TABLE pembayaran (
  id_bayar INT AUTO_INCREMENT PRIMARY KEY,
  id_penyewa INT,
  tgl_bayar DATE NOT NULL,
  bulan VARCHAR(20) NOT NULL,
  status_bayar ENUM('lunas','belum') DEFAULT 'belum',
  FOREIGN KEY (id_penyewa) REFERENCES penyewa(id_penyewa) ON DELETE CASCADE
);
