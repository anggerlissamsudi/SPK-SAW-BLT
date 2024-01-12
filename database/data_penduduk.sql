-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2022 pada 08.54
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `data_penduduk`
--
CREATE DATABASE IF NOT EXISTS `data_penduduk` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `data_penduduk`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kec`
--

CREATE TABLE IF NOT EXISTS `master_kec` (
  `kode_kec` int(11) NOT NULL,
  `nama_kec` varchar(20) NOT NULL,
  `kode_kota` int(11) NOT NULL,
  PRIMARY KEY (`kode_kec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kel`
--

CREATE TABLE IF NOT EXISTS `master_kel` (
  `kode_kel` int(11) NOT NULL,
  `nama_kel` varchar(20) NOT NULL,
  `kode_kec` int(11) NOT NULL,
  PRIMARY KEY (`kode_kel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_dokumen`
--

CREATE TABLE IF NOT EXISTS `tabel_dokumen` (
  `id_dokumen` int(20) NOT NULL,
  `nama_dokumen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_dokumen`
--

INSERT INTO `tabel_dokumen` (`id_dokumen`, `nama_dokumen`) VALUES
(1, 'F.1-01'),
(2, 'F.1-03'),
(3, 'Surat Keterangan Kelahiran dari Kelurahan'),
(4, 'F.1-05'),
(5, 'KK Lama'),
(6, 'Surat Pindah Datang'),
(7, 'Copy Ijazah'),
(8, 'Surat Kematian'),
(9, 'Copy Surat Nikah/Cerai'),
(10, 'Copy KTP'),
(11, 'Copy Akta Kelahiran'),
(12, 'F1.21'),
(13, 'Copy KK'),
(14, 'Copy Akta Lahir'),
(15, 'Surat Keterangan kehilangan'),
(16, 'KTP Rusak/Lama'),
(17, 'KIA Untuk Pemula'),
(18, 'KTP Ortu'),
(19, 'Pas Foto'),
(20, 'F.2-01'),
(21, 'F.2-02'),
(22, 'F.2-03'),
(23, 'F.2-04'),
(24, 'F.2-08'),
(25, 'F.2-09'),
(26, 'F.2-10'),
(27, 'F.2-11'),
(28, 'Copy KTP Ortu'),
(29, 'Copy KTP Saksi'),
(30, 'Copy Akta Nikah'),
(31, 'Surat Bidan'),
(32, 'F.2-28'),
(33, 'F.2-29'),
(34, 'F.2-30'),
(35, 'F.2-31'),
(36, 'F.2-32'),
(37, 'F.2-33'),
(38, 'F.2-34'),
(39, 'F.1-08'),
(40, 'F.1-09'),
(41, 'F.1-10'),
(42, 'KK'),
(43, 'KTP Asli'),
(44, 'Copy Akta Nikah/Cerai'),
(45, 'Surat Pemberkatan dari Pemuka Agama Asli'),
(46, 'Copy Surat Baptis/ Anggota Agama '),
(47, 'Copy Akta Kelahiran Legalisir'),
(48, 'Copy KTP kedua Mempelai dan Ortu. legalisir'),
(49, 'Copy KK Legalisir'),
(50, 'Surat Keterangan Sehat'),
(51, 'Pas Foto 4x6'),
(52, 'Copy Surat Nikah Ortu'),
(53, 'Blangko Perkawinan'),
(54, 'Copy KTP diperbesar 2x Kertas Folio'),
(55, 'Putusan Pengadilan (Legalisir)'),
(56, 'Akta Nikah Asli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_pengurusan`
--

CREATE TABLE IF NOT EXISTS `tabel_pengurusan` (
  `id_pengurusan` int(20) NOT NULL,
  `nama_pengurusan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_pengurusan`
--

INSERT INTO `tabel_pengurusan` (`id_pengurusan`, `nama_pengurusan`) VALUES
(1, 'KK'),
(2, 'KTP'),
(3, 'KIA'),
(4, 'Akta Lahir'),
(5, 'Akta Mati'),
(6, 'SKPD'),
(7, 'Akta Perkawinan'),
(8, 'Akta Perceraian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_syaratpengurusan`
--

CREATE TABLE IF NOT EXISTS `tabel_syaratpengurusan` (
  `id` int(20) NOT NULL,
  `id_pengurusan` int(20) NOT NULL,
  `id_dokumen` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_verifikasi`
--

CREATE TABLE IF NOT EXISTS `tabel_verifikasi` (
  `id_kendali` int(15) NOT NULL AUTO_INCREMENT,
  `id_pengurusan` int(100) NOT NULL,
  `nik` int(30) NOT NULL,
  `nama_pemohon` varchar(50) NOT NULL,
  `tempat_lahir` date NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `kelurahan` varchar(20) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `tgl_permohonan` date NOT NULL,
  `petugas_pelayanan` varchar(50) NOT NULL,
  `tgl_verif_pelayanan` date NOT NULL,
  `jam_verif_pelayanan` time NOT NULL,
  `status_verif_pelayanan` varchar(20) NOT NULL,
  `catatan_pelayanan` varchar(1000) NOT NULL,
  `kasi` varchar(50) NOT NULL,
  `tgl_verif_kasi` date NOT NULL,
  `jam_verif_kasi` time NOT NULL,
  `kasi2` varchar(50) NOT NULL,
  `tgl_verif_kasi2` date NOT NULL,
  `jam_verif_kasi2` time NOT NULL,
  `status_verif_kasi` varchar(20) NOT NULL,
  `catatan_kasi` varchar(100) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `tgl_verif_operator` date NOT NULL,
  `jam_verif_operator` time NOT NULL,
  `operator2` varchar(50) NOT NULL,
  `tgl_verif_operator2` date NOT NULL,
  `jam_verif_operator2` time NOT NULL,
  `status_verif_operator` varchar(20) NOT NULL,
  `catatan_operator` varchar(100) NOT NULL,
  `kabid` varchar(50) NOT NULL,
  `tgl_verif_kabid` date NOT NULL,
  `jam_verif_kabid` time NOT NULL,
  `status_verif_kabid` varchar(20) NOT NULL,
  `catatan_kabid` varchar(100) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl_verif_petugas` date NOT NULL,
  `jam_verif_petugas` time NOT NULL,
  `petugas2` varchar(50) NOT NULL,
  `tgl_verif_petugas2` date NOT NULL,
  `jam_verif_petugas2` time NOT NULL,
  `status_verif_petugas` varchar(20) NOT NULL,
  `catatan_petugas` varchar(100) NOT NULL,
  `kepdinas` varchar(50) NOT NULL,
  `tgl_verif_kepdinas` date NOT NULL,
  `jam_verif_kepdinas` time NOT NULL,
  `status_verif_kepdinas` varchar(20) NOT NULL,
  `catatan_kepdinas` varchar(100) NOT NULL,
  `pemohon` varchar(50) NOT NULL,
  `tgl_verif_pemohon` date NOT NULL,
  `jam_verif_pemohon` time NOT NULL,
  `status_verif_pemohon` varchar(20) NOT NULL,
  `catatan_pemohon` varchar(100) NOT NULL,
  `arsip` varchar(50) NOT NULL,
  `tgl_verif_arsip` date NOT NULL,
  `jam_verif_arsip` time NOT NULL,
  `status_verif_arsip` varchar(20) NOT NULL,
  `catatan_arsip` time NOT NULL,
  PRIMARY KEY (`id_kendali`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_verif_dokumen`
--

CREATE TABLE IF NOT EXISTS `tabel_verif_dokumen` (
  `id_kendali` int(15) NOT NULL,
  `id_dokumen` int(20) NOT NULL,
  PRIMARY KEY (`id_kendali`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE IF NOT EXISTS `tb_anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_kk` int(11) NOT NULL,
  `id_pend` int(11) NOT NULL,
  `hubungan` varchar(15) NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `tb_anggota_ibfk_1` (`id_pend`),
  KEY `id_kk` (`id_kk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `id_kk`, `id_pend`, `hubungan`) VALUES
(19, 7, 23, 'Istri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_datang`
--

CREATE TABLE IF NOT EXISTS `tb_datang` (
  `id_datang` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama_datang` varchar(20) NOT NULL,
  `jekel` enum('LK','PR') NOT NULL,
  `tgl_datang` date NOT NULL,
  `pelapor` int(11) NOT NULL,
  PRIMARY KEY (`id_datang`),
  KEY `pelapor` (`pelapor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tb_datang`
--

INSERT INTO `tb_datang` (`id_datang`, `nik`, `nama_datang`, `jekel`, `tgl_datang`, `pelapor`) VALUES
(5, '6357672572552', 'Mbah Sri Rejo', 'LK', '1945-08-17', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kk`
--

CREATE TABLE IF NOT EXISTS `tb_kk` (
  `id_kk` int(11) NOT NULL AUTO_INCREMENT,
  `no_kk` varchar(30) NOT NULL,
  `kepala` varchar(20) NOT NULL,
  `desa` varchar(20) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `kec` varchar(20) NOT NULL,
  `kab` varchar(20) NOT NULL,
  `prov` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tb_kk`
--

INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `kepala`, `desa`, `rt`, `rw`, `kec`, `kab`, `prov`) VALUES
(7, '12345678109987', 'Arif S', 'balong', '01', '03', 'Dawarblandong', 'Mojokerto', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lahir`
--

CREATE TABLE IF NOT EXISTS `tb_lahir` (
  `id_lahir` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `tgl_lh` date NOT NULL,
  `jekel` enum('LK','PR') NOT NULL,
  `id_kk` int(11) NOT NULL,
  PRIMARY KEY (`id_lahir`),
  KEY `id_kk` (`id_kk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tb_lahir`
--

INSERT INTO `tb_lahir` (`id_lahir`, `nama`, `tgl_lh`, `jekel`, `id_kk`) VALUES
(6, 'ABYAN RAFA AL FARIZI', '2022-03-02', 'LK', 7),
(7, 'Niklas Sule', '2022-03-01', 'LK', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mendu`
--

CREATE TABLE IF NOT EXISTS `tb_mendu` (
  `id_mendu` int(11) NOT NULL AUTO_INCREMENT,
  `id_pdd` int(11) NOT NULL,
  `tgl_mendu` date NOT NULL,
  `sebab` varchar(20) NOT NULL,
  PRIMARY KEY (`id_mendu`),
  KEY `id_pdd` (`id_pdd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tb_mendu`
--

INSERT INTO `tb_mendu` (`id_mendu`, `id_pdd`, `tgl_mendu`, `sebab`) VALUES
(5, 25, '2021-08-09', 'Telat Makan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pdd`
--

CREATE TABLE IF NOT EXISTS `tb_pdd` (
  `id_pend` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tempat_lh` varchar(15) NOT NULL,
  `tgl_lh` date NOT NULL,
  `jekel` enum('LK','PR') NOT NULL,
  `desa` varchar(15) NOT NULL,
  `rt` varchar(4) NOT NULL,
  `rw` varchar(4) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `kawin` varchar(15) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `status` enum('Ada','Meninggal','Pindah') NOT NULL,
  PRIMARY KEY (`id_pend`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data untuk tabel `tb_pdd`
--

INSERT INTO `tb_pdd` (`id_pend`, `nik`, `nama`, `tempat_lh`, `tgl_lh`, `jekel`, `desa`, `rt`, `rw`, `agama`, `kawin`, `pekerjaan`, `status`) VALUES
(22, '3517032208000001', 'Arif S', 'Mojokerto', '1999-02-22', 'LK', 'balong', '01', '03', 'Islam', 'Sudah', 'Wiraswasta', 'Ada'),
(23, '3517022309000002', 'Ilham ayu saputri', 'Madiun', '2000-02-23', 'PR', 'Wungu', '08', '03', 'Islam', 'Sudah', 'Ibu rumah tangga', 'Ada'),
(24, '3517270900098001', 'Tum', 'Jombang', '2006-09-27', 'LK', 'jombok', '01', '01', 'Islam', 'Belum', 'Mahasiswa', 'Pindah'),
(25, '3592894613961598', 'eri wandayanti', 'Mojokerto', '2006-09-22', 'PR', 'balong', '03', '02', 'Islam', 'Belum', 'Pelajar', 'Meninggal'),
(26, '3516173101010001', 'Muhamad Arif Saifudi', 'Mojokerto', '2001-01-31', 'LK', 'Banyulegi', '02', '09', 'Islam', 'Belum', 'Pengusaha Batu Bata', 'Ada'),
(27, '3516173101010001', 'Ilham Ainur', 'Madiun', '2001-05-08', 'LK', 'Munggu', '23', '6', 'Islam', 'Belum', 'Mahasiswa', 'Ada'),
(28, '3516173101010001', 'Ilham Ainur', 'Surabaya', '2015-02-09', 'LK', 'Munggu', '02', '6', 'Islam', 'Belum', 'Pengusaha Batu Bata', 'Ada'),
(32, '3516173101010001', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Ada'),
(33, '892', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Ada'),
(35, '', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Ada'),
(36, '', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Ada'),
(37, '', '', '', '0000-00-00', '', '', '', '', '', '', '', 'Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Administrator','Kaur Pemerintah') NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'Arif cumlod', 'admin', 'admin', 'Administrator'),
(3, 'Iham basarnas', 'admin2', 'admin2', 'Kaur Pemerintah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pindah`
--

CREATE TABLE IF NOT EXISTS `tb_pindah` (
  `id_pindah` int(11) NOT NULL AUTO_INCREMENT,
  `id_pdd` int(11) NOT NULL,
  `tgl_pindah` date NOT NULL,
  `alasan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pindah`),
  KEY `id_pdd` (`id_pdd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tb_pindah`
--

INSERT INTO `tb_pindah` (`id_pindah`, `id_pdd`, `tgl_pindah`, `alasan`) VALUES
(5, 24, '2021-09-09', 'Pindah Rumah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `bagian` enum('Petugas','Operator','Kasi','Kabid','Kepala Dinas','Pelayanan','Arsip') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_pend`) REFERENCES `tb_pdd` (`id_pend`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_anggota_ibfk_2` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_datang`
--
ALTER TABLE `tb_datang`
  ADD CONSTRAINT `tb_datang_ibfk_1` FOREIGN KEY (`pelapor`) REFERENCES `tb_pdd` (`id_pend`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_lahir`
--
ALTER TABLE `tb_lahir`
  ADD CONSTRAINT `tb_lahir_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_mendu`
--
ALTER TABLE `tb_mendu`
  ADD CONSTRAINT `tb_mendu_ibfk_1` FOREIGN KEY (`id_pdd`) REFERENCES `tb_pdd` (`id_pend`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pindah`
--
ALTER TABLE `tb_pindah`
  ADD CONSTRAINT `tb_pindah_ibfk_1` FOREIGN KEY (`id_pdd`) REFERENCES `tb_pdd` (`id_pend`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
