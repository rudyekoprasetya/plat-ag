-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2020 pada 11.34
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plat_ag`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_aktif` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `email`, `password`, `is_aktif`) VALUES
(1, 'rudyekoprasetya@yahoo.co.id', '$2y$10$S/xTSKGiJ97g.h3wvudrW.OJbdgL3De06GPBJSbQfQa39imhPh3BG', 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_channel`
--

CREATE TABLE `tb_channel` (
  `id_channel` bigint(100) NOT NULL,
  `channel_id` varchar(100) DEFAULT NULL,
  `project_id` varchar(100) DEFAULT NULL,
  `channel_name` varchar(20) DEFAULT NULL,
  `tipe` enum('read','write') DEFAULT NULL,
  `is_aktif` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data`
--

CREATE TABLE `tb_data` (
  `id` bigint(100) NOT NULL,
  `channel_id` varchar(100) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_project`
--

CREATE TABLE `tb_project` (
  `id_project` bigint(100) NOT NULL,
  `project_id` varchar(100) DEFAULT NULL,
  `id_user` bigint(10) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `mikrokontroller` varchar(60) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `is_aktif` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sessions`
--

CREATE TABLE `tb_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sessions`
--

INSERT INTO `tb_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('034575tvsckhcgdn01sn4ja8omljmt2t', '::1', 1601543740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534333734303b656d61696c7c733a32353a2272756479656b6f707261736574796140676d61696c2e636f6d223b6c6f676765645f696e7c623a313b),
('1thtbn45o78ft0bvnh31os9bqqvjjd8n', '::1', 1601544346, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534343334363b656d61696c7c733a32353a2272756479656b6f707261736574796140676d61696c2e636f6d223b6c6f676765645f696e7c623a313b),
('1tqhqmqbb79dm2btfsgfnib68saj7s9f', '::1', 1601540522, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534303532323b),
('21buuiggrgvn2kma9214mflip7tobbaa', '::1', 1601539750, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313533393735303b6d6573736167657c733a3132333a223c64697620636c6173733d22616c65727420616c6572742d737563636573732220726f6c653d22616c657274223e436f6e67726174756c6174696f6e2c20596f7572204163636f756e7420697320526567697374657265642c20506c6561736520616374697661746520796f7572206163636f75743c2f6469763e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('8gknqedr8jd9sk14j7i4f9erm82si95j', '::1', 1601544043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534343034333b656d61696c7c733a32353a2272756479656b6f707261736574796140676d61696c2e636f6d223b6c6f676765645f696e7c623a313b),
('dl3mt4k9lf32j3s901ej3q2pghdfa533', '::1', 1601540823, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534303832333b),
('f1sad9di2fkt30md4quqcdg4ugkpaih7', '::1', 1601542599, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534323539393b),
('meugr4j62akbpkocdj7q6numefios8vn', '::1', 1601541256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534313235363b6d6573736167657c733a36363a223c64697620636c6173733d22616c65727420616c6572742d64616e6765722220726f6c653d22616c657274223e57726f6e672050617373776f7264213c2f6469763e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('p37gkgsh5pmht57f2s538dpeoghnf79j', '::1', 1601543307, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534333330373b656d61696c7c733a32353a2272756479656b6f707261736574796140676d61696c2e636f6d223b6c6f676765645f696e7c623a313b),
('sq2j2q092sltg2gmpqpn50k0er7lu97u', '::1', 1601544706, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313534343539363b),
('v4ak2k4d3bqdup14etke01ql1g8pudao', '::1', 1601539420, 0x5f5f63695f6c6173745f726567656e65726174657c693a313630313533393432303b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` bigint(100) NOT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` tinytext DEFAULT NULL,
  `is_aktif` enum('yes','no') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `api_key`, `email`, `password`, `nama`, `gender`, `tgl_lahir`, `alamat`, `foto`, `is_aktif`, `created_at`) VALUES
(4, '42be7490e81b3a0866a77088f21b1db0', 'rudyekoprasetya@gmail.com', '$2y$10$L8UoARYfKhKOGtiYPgZzD.99NSfxCmdyKNSnPJGg8nMr0SkCPSTBK', 'Rudy Eko', 'L', NULL, NULL, 'default.jpg', 'no', '2020-10-01 15:29:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_channel`
--
ALTER TABLE `tb_channel`
  ADD PRIMARY KEY (`id_channel`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indeks untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indeks untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_sessions`
--
ALTER TABLE `tb_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_channel`
--
ALTER TABLE `tb_channel`
  MODIFY `id_channel` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id_project` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_channel`
--
ALTER TABLE `tb_channel`
  ADD CONSTRAINT `tb_channel_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tb_project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_project`
--
ALTER TABLE `tb_project`
  ADD CONSTRAINT `tb_project_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
