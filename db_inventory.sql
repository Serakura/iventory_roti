-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2023 pada 14.04
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(12) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `stok` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`) VALUES
(1, 'Tepung Terigus', 10.2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahanbaku` int(12) NOT NULL,
  `id_bahan` int(12) NOT NULL,
  `id_produksi` int(12) NOT NULL,
  `jumlah_bahanbaku` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `bahan_baku`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok_bahan` AFTER INSERT ON `bahan_baku` FOR EACH ROW BEGIN
    UPDATE bahan
    set stok = stok-new.jumlah_bahanbaku
    WHERE id_bahan = new.id_bahan; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat_asal` text NOT NULL,
  `alamat_sekarang` text DEFAULT NULL,
  `bidang_pekerjaan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat_asal`, `alamat_sekarang`, `bidang_pekerjaan`) VALUES
(2, 'Test', '2022-11-30', 'Laki-laki', '234', 'Gamping', 'Gamping', 'Pemasaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(12) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stok` int(12) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `stok`, `harga`) VALUES
(1, 'Roti Coklat', 50, 12500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(12) NOT NULL,
  `id_produk` int(12) NOT NULL,
  `jumlah_produksi` int(12) NOT NULL,
  `tanggal_produksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_produk`, `jumlah_produksi`, `tanggal_produksi`) VALUES
(4, 1, 100, '2022-11-30');

--
-- Trigger `produksi`
--
DELIMITER $$
CREATE TRIGGER `update_stok_produk` AFTER INSERT ON `produksi` FOR EACH ROW BEGIN
    UPDATE produk
    set stok = stok+new.jumlah_produksi
    WHERE id_produk = new.id_produk; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_keluar`
--

CREATE TABLE `produk_keluar` (
  `id_produkkeluar` int(12) NOT NULL,
  `id_produk` int(12) NOT NULL,
  `id_pegawai` int(12) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_keluar`
--

INSERT INTO `produk_keluar` (`id_produkkeluar`, `id_produk`, `id_pegawai`, `jumlah`, `tanggal_keluar`) VALUES
(3, 1, 2, 50, '2022-11-30');

--
-- Trigger `produk_keluar`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok_produk` AFTER INSERT ON `produk_keluar` FOR EACH ROW BEGIN
    UPDATE produk
    set stok = stok-new.jumlah
    WHERE id_produk = new.id_produk; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_retur`
--

CREATE TABLE `produk_retur` (
  `id_produkretur` int(12) NOT NULL,
  `id_produk` int(12) NOT NULL,
  `id_pegawai` int(12) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `tanggal_retur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_retur`
--

INSERT INTO `produk_retur` (`id_produkretur`, `id_produk`, `id_pegawai`, `jumlah`, `tanggal_retur`) VALUES
(2, 1, 2, 25, '2022-12-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplay_bahan`
--

CREATE TABLE `supplay_bahan` (
  `id_supplay` int(12) NOT NULL,
  `id_supplier` int(12) NOT NULL,
  `id_bahan` int(12) NOT NULL,
  `jumlah` float NOT NULL,
  `harga` int(12) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplay_bahan`
--

INSERT INTO `supplay_bahan` (`id_supplay`, `id_supplier`, `id_bahan`, `jumlah`, `harga`, `tanggal`) VALUES
(9, 2, 1, 12.2, 123123, '2022-11-22');

--
-- Trigger `supplay_bahan`
--
DELIMITER $$
CREATE TRIGGER `update_stok_bahan` AFTER INSERT ON `supplay_bahan` FOR EACH ROW BEGIN
    UPDATE bahan
    set stok = stok+new.jumlah
    WHERE id_bahan = new.id_bahan; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(12) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(2, 'PT. Tepung Asian', 'Jln. hooh tenan 123', '098456345345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('Admin','Pemilik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_admin`
--

INSERT INTO `user_admin` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(2, 'arief', 'arief', '123', 'Admin'),
(3, 'budiman', 'budiman', '123', 'Pemilik');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahanbaku`),
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `id_produksi` (`id_produksi`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD PRIMARY KEY (`id_produkkeluar`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `produk_retur`
--
ALTER TABLE `produk_retur`
  ADD PRIMARY KEY (`id_produkretur`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `supplay_bahan`
--
ALTER TABLE `supplay_bahan`
  ADD PRIMARY KEY (`id_supplay`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahanbaku` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk_keluar`
--
ALTER TABLE `produk_keluar`
  MODIFY `id_produkkeluar` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk_retur`
--
ALTER TABLE `produk_retur`
  MODIFY `id_produkretur` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `supplay_bahan`
--
ALTER TABLE `supplay_bahan`
  MODIFY `id_supplay` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD CONSTRAINT `bahan_baku_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`),
  ADD CONSTRAINT `bahan_baku_ibfk_2` FOREIGN KEY (`id_produksi`) REFERENCES `produksi` (`id_produksi`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD CONSTRAINT `produk_keluar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `produk_keluar_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk_retur`
--
ALTER TABLE `produk_retur`
  ADD CONSTRAINT `produk_retur_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `produk_retur_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `supplay_bahan`
--
ALTER TABLE `supplay_bahan`
  ADD CONSTRAINT `supplay_bahan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `supplay_bahan_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
