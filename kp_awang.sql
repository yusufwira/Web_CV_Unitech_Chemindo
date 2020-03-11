-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2020 pada 14.16
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp_awang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(11) NOT NULL,
  `nama_barang` varchar(45) DEFAULT NULL,
  `stock_barang` int(11) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idBarang`, `nama_barang`, `stock_barang`, `satuan`) VALUES
(2, 'Kertas', 82, 'ons'),
(4, 'Baut 2.0', 10, ''),
(5, 'Linier Bearing LM 16 UU', 0, ''),
(6, 'sutra', 90, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota_pembelian`
--

CREATE TABLE `nota_pembelian` (
  `suplier_idsuplier` int(11) NOT NULL,
  `barang_idBarang` int(11) NOT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `nota_pembelian`
--

INSERT INTO `nota_pembelian` (`suplier_idsuplier`, `barang_idBarang`, `jumlah_barang`, `tanggal`) VALUES
(1, 2, 50, '2020-01-28'),
(2, 2, 50, '2020-01-28'),
(3, 2, 10, '2020-01-29'),
(1, 4, 100, '2020-02-01'),
(2, 5, 100, '2020-01-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `idpenggunaan` int(11) NOT NULL,
  `jumlah_digunakan` int(11) DEFAULT NULL,
  `tanggal_penggunaan` date DEFAULT NULL,
  `barang_idBarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`idpenggunaan`, `jumlah_digunakan`, `tanggal_penggunaan`, `barang_idBarang`) VALUES
(4, 10, '2020-01-31', 2),
(5, 90, '2020-02-05', 4),
(6, 90, '2020-01-29', 5),
(7, 10, '2020-01-30', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `idsuplier` int(11) NOT NULL,
  `nama_suplier` varchar(45) DEFAULT NULL,
  `alamat_suplier` varchar(45) DEFAULT NULL,
  `notelp_suplier` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`idsuplier`, `nama_suplier`, `alamat_suplier`, `notelp_suplier`) VALUES
(1, 'PT. Bumi Mas Abadi Jaya', 'Jl. Selong perum nasional', '08123242533'),
(2, 'PT. Maju Mundur', 'Jl,Tenggilis Mejoyo', '0831232434534'),
(3, 'PT. Jaya Lebak Swangar', 'Jl. Lebak Jaya 1 No 31', '031-1821485'),
(6, 'PT. Awang coop', 'Lapangan Wisata Kuliner Arum Dalu Raya Juanda', '081216252500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indeks untuk tabel `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD KEY `fk_suplier_has_barang_barang1_idx` (`barang_idBarang`),
  ADD KEY `fk_suplier_has_barang_suplier_idx` (`suplier_idsuplier`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`idpenggunaan`),
  ADD KEY `fk_penggunaan_barang1_idx` (`barang_idBarang`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`idsuplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `idpenggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `suplier`
--
ALTER TABLE `suplier`
  MODIFY `idsuplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD CONSTRAINT `fk_suplier_has_barang_barang1` FOREIGN KEY (`barang_idBarang`) REFERENCES `barang` (`idBarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_suplier_has_barang_suplier` FOREIGN KEY (`suplier_idsuplier`) REFERENCES `suplier` (`idsuplier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `fk_penggunaan_barang1` FOREIGN KEY (`barang_idBarang`) REFERENCES `barang` (`idBarang`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
