-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2021 pada 11.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo_administrasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata_santri`
--

CREATE TABLE `biodata_santri` (
  `nis` int(11) NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `id_univ` int(10) NOT NULL,
  `id_angk` int(10) NOT NULL,
  `id_status` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biodata_santri`
--

INSERT INTO `biodata_santri` (`nis`, `nama_santri`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `jurusan`, `id_univ`, `id_angk`, `id_status`, `foto`) VALUES
(156789, 'Wardatul Jannah', 'Pasuruan', '1999-12-02', 'P', 'Malang', 'Akutansi', 2, 3, 1, '156789.jpg'),
(11134567, 'Anjar', 'Gresik', '2000-05-15', 'L', 'Gresik', 'Teknik Informatika', 1, 3, 1, '11134567.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kamar`
--

CREATE TABLE `data_kamar` (
  `id_kamar` int(255) NOT NULL,
  `id_ka` int(10) NOT NULL,
  `nama_penghuni` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kuota_kamar` int(10) NOT NULL,
  `id_angk` int(255) NOT NULL,
  `id_status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_kamar`
--

INSERT INTO `data_kamar` (`id_kamar`, `id_ka`, `nama_penghuni`, `jenis_kelamin`, `kuota_kamar`, `id_angk`, `id_status`) VALUES
(16, 8, 'Iva Himmatul Aliyah', 'P', 8, 2, 2),
(17, 7, 'Wardatul Jannah', 'P', 2, 4, 1),
(20, 8, 'Ainul Yaqin', 'L', 3, 4, 1),
(21, 11, 'faisal', 'L', 2, 1, 1),
(22, 8, 'Wardatul Jannah', 'P', 2, 5, 1),
(32, 14, 'Reva', 'P', 1, 4, 2),
(33, 14, 'Rika', 'P', 2, 3, 3),
(34, 15, 'Siska', 'P', 2, 1, 2),
(35, 10, 'Warda', 'P', 3, 4, 1);

--
-- Trigger `data_kamar`
--
DELIMITER $$
CREATE TRIGGER `delete_data_kamar` AFTER DELETE ON `data_kamar` FOR EACH ROW INSERT INTO nama_kamar SET
 id_ka = OLD.id_ka, kuota_kamar=OLD.kuota_kamar
 ON DUPLICATE KEY UPDATE kuota_kamar=kuota_kamar+OLD.kuota_kamar
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_data_kamar` AFTER INSERT ON `data_kamar` FOR EACH ROW INSERT INTO nama_kamar SET
 id_ka = NEW.id_ka, kuota_kamar=New.kuota_kamar
 ON DUPLICATE KEY UPDATE kuota_kamar=kuota_kamar-New.kuota_kamar
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_data_kamar` AFTER UPDATE ON `data_kamar` FOR EACH ROW IF (NEW.kuota_kamar > OLD.kuota_kamar)
  THEN
           INSERT INTO nama_kamar SET
 id_ka = NEW.id_ka, kuota_kamar=New.kuota_kamar
 ON DUPLICATE KEY UPDATE kuota_kamar=kuota_kamar-(New.kuota_kamar-Old.kuota_kamar);
      ELSE
                 INSERT INTO nama_kamar SET
 id_ka = NEW.id_ka, kuota_kamar=New.kuota_kamar
 ON DUPLICATE KEY UPDATE kuota_kamar=kuota_kamar+(OLD.kuota_kamar-NEW.kuota_kamar);
      END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dewan_kyai`
--

CREATE TABLE `dewan_kyai` (
  `id_kyai` int(10) NOT NULL,
  `nama_kyai` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dewan_kyai`
--

INSERT INTO `dewan_kyai` (`id_kyai`, `nama_kyai`, `foto`) VALUES
(17, 'KH.Abdul Hamid', 'profile2.jpg'),
(20, 'Kyai Abdul Rozak', 'kyai_k.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Ahad'),
(2, 'Senin'),
(3, 'Selasa'),
(4, 'Rabu'),
(5, 'Kamis'),
(6, 'Jum\'at'),
(7, 'sabtu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_edit_santri`
--

CREATE TABLE `histori_edit_santri` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `tgl_diedit` datetime NOT NULL,
  `diedit_oleh` enum('admin','santri') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_ms`
--

CREATE TABLE `jabatan_ms` (
  `id_jabatan` int(10) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan_ms`
--

INSERT INTO `jabatan_ms` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Ketua Umum'),
(2, 'Ketua 1 Putra'),
(3, 'Ketua 1 Putri'),
(4, 'Ketua 2 Putra'),
(5, 'Ketua 2 Putri'),
(6, 'Ketua 3 Putra'),
(7, 'Ketua 3 Putri'),
(8, 'Sekretaris Umum'),
(9, 'Sekretaris'),
(10, 'Bendahara Umum'),
(11, 'Bendahara'),
(12, 'Departemen Keamanan'),
(13, 'Departemen Kesejahteraan Santri'),
(14, 'Departemen Penelitian dan Pengembangan'),
(15, 'Departemen Minat dan Bakat'),
(16, 'Departemen Peribadatan'),
(17, 'Departemen Takmir'),
(18, 'Departemen Lingkungan Hidup'),
(19, 'Tim Multimedia'),
(20, 'Departemen Informasi dan Komunikasi'),
(21, 'Departemen Sarana dan Prasarana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jumlah_santri`
--

CREATE TABLE `jumlah_santri` (
  `id_jumlah` int(5) NOT NULL,
  `jumlah_putra` int(5) NOT NULL,
  `jumlah_putri` int(5) NOT NULL,
  `jumlah_total` int(5) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jumlah_santri`
--

INSERT INTO `jumlah_santri` (`id_jumlah`, `jumlah_putra`, `jumlah_putri`, `jumlah_total`, `tahun`) VALUES
(1, 115, 100, 215, 2014);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, ' Diniyah A Putra'),
(2, ' Diniyah B Putra'),
(3, 'Diniyah C Putra'),
(4, 'Diniyah A Putri'),
(5, 'Dinyah B putri'),
(6, 'Diniyah C1 Putri'),
(7, 'Diniyah C2 Putri'),
(8, 'Diniyah C3 Putri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kitab`
--

CREATE TABLE `kitab` (
  `id_kitab` int(5) NOT NULL,
  `nama_kitab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kitab`
--

INSERT INTO `kitab` (`id_kitab`, `nama_kitab`) VALUES
(1, 'Al-qowaidun nahwi al-wadhifi'),
(2, '‘Idhotun Nasyiin'),
(3, 'Jawahirul Balaghoh'),
(4, 'Al-adzkar an-nawawiyyah'),
(5, 'Nashoihul ‘ibad'),
(6, 'Tafsir jalalain'),
(7, 'Bulughul Marom'),
(8, 'Al-kawakib ad-durriyyah'),
(9, 'Al Ajwibah Al Gholiyah fi ‘Aqidatil firqoh An Najiyah'),
(10, 'Bada’iuzzuhur '),
(11, 'Subulus salam'),
(12, 'Mau’idhotul mukminin'),
(13, 'Al-Ashbah wan-nadhoir,\r\n'),
(14, 'Al-qur’anul Karim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `madin`
--

CREATE TABLE `madin` (
  `id_ma` int(11) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `nama_ust` varchar(255) NOT NULL,
  `id_mapel` int(255) NOT NULL,
  `id_hari` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `madin`
--

INSERT INTO `madin` (`id_ma`, `id_kelas`, `nama_ust`, `id_mapel`, `id_hari`) VALUES
(32, 3, 'Ust. Arif', 4, 4),
(34, 3, 'Ust. Arif', 4, 4),
(35, 3, 'Ust. Arif', 4, 4),
(36, 3, 'Ust. Arif', 4, 4),
(37, 3, 'Ust. Arif', 4, 4),
(38, 3, 'Ust. Arif', 4, 4),
(39, 3, 'Ust. Arif', 4, 4),
(40, 3, 'Ust. Arif', 4, 4),
(41, 3, 'Ust. Arif', 4, 4),
(42, 3, 'Ust. Arif', 4, 4),
(43, 3, 'Ust. Arif', 4, 4),
(44, 3, 'Ust. Arif', 4, 4),
(45, 3, 'Ust. Arif', 4, 4),
(46, 3, 'Ust. Arif', 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `majelis_santri`
--

CREATE TABLE `majelis_santri` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_jabatan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `majelis_santri`
--

INSERT INTO `majelis_santri` (`id`, `nis`, `id_jabatan`) VALUES
(5, 11134567, 6),
(7, 156789, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(10) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Nahwu'),
(2, 'Shorof'),
(3, 'Fiqih'),
(4, 'Aqidatul \'Awam'),
(5, 'Al-qur\'an');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_angkatan`
--

CREATE TABLE `nama_angkatan` (
  `id_angk` int(10) NOT NULL,
  `nama_angk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_angkatan`
--

INSERT INTO `nama_angkatan` (`id_angk`, `nama_angk`) VALUES
(1, 'Hamasah 2016'),
(2, 'Najah 2017'),
(3, 'Tabassam 2018'),
(4, 'Himmah 2019'),
(5, 'Hasta 2015'),
(9, 'Hazimah 2020'),
(11, 'Rizqiyyah2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_kamar`
--

CREATE TABLE `nama_kamar` (
  `id_ka` int(10) NOT NULL,
  `nama_ka` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kuota_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_kamar`
--

INSERT INTO `nama_kamar` (`id_ka`, `nama_ka`, `jenis_kelamin`, `kuota_kamar`) VALUES
(7, 'Azka 1', 'Putri', 12),
(8, 'A1', 'Putra', 4),
(9, 'C1', 'L', 8),
(10, 'E1', 'P', 9),
(11, 'A7', 'L', 30),
(12, 'E1', 'P', 10),
(13, 'Tes Kamar', 'L', 12),
(14, 'E5', 'P', 1),
(15, 'D4', 'P', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajian`
--

CREATE TABLE `pengajian` (
  `id_ngaji` int(5) NOT NULL,
  `id_kyai` int(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_kitab` int(5) NOT NULL,
  `id_hari` int(10) NOT NULL,
  `id_w` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajian`
--

INSERT INTO `pengajian` (`id_ngaji`, `id_kyai`, `foto`, `id_kitab`, `id_hari`, `id_w`) VALUES
(3, 20, '', 4, 3, 2),
(4, 17, '', 2, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_santri`
--

CREATE TABLE `status_santri` (
  `id_status` int(25) NOT NULL,
  `nama_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_santri`
--

INSERT INTO `status_santri` (`id_status`, `nama_status`) VALUES
(1, 'Aktif Majelis Santri'),
(2, 'Aktif Non Majelis Santri'),
(3, 'Aktif dan Ahlul Ma\'had'),
(4, 'Tidak Aktif (Alumni)'),
(5, 'Tidak aktif dan Ahlul Ma\'had'),
(8, 'Boyong'),
(11, 'Dipesantren');

-- --------------------------------------------------------

--
-- Struktur dari tabel `univ`
--

CREATE TABLE `univ` (
  `id_univ` int(10) NOT NULL,
  `nama_univ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `univ`
--

INSERT INTO `univ` (`id_univ`, `nama_univ`) VALUES
(1, 'UNIVERSITAS BRAWIJAYA'),
(2, 'UNIVERSITAS NEGERI MALANG'),
(3, 'UNIVERSITAS ISLAM MAULANA MALIK IBRAHIM MALANG'),
(4, 'UNIVERSITAS MUHAMMADIYAH MALANG'),
(5, 'POLITEKNIK NEGERI MALANG'),
(6, 'POLTEKKES MALANG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nis` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `edit_role` varchar(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `nis`, `role_id`, `edit_role`, `is_active`, `date_created`) VALUES
(3, 'Wardatul Jannah', 'wardatuljannah525@gmail.com', 'default.jpg', '$2y$10$/3l8kxkv0meuathk2OxK.OHgKJQJk7muOQ3hf7RNVByFF3HFfjS9q', 156789, 1, '', 1, 1622640493),
(4, 'Yasri Rahmawati', 'yasri@gmail.com', 'profile.jpg', '$2y$10$mvuVl3FB2t5pSEUft21DU.2QekLXKl2wMdmvW3oIDr6aP8Yf9YsQ2', 0, 3, '', 1, 1622769135),
(5, 'Risza Nuril', 'risza@gmail.com', 'default.jpg', '$2y$10$P7s7MY99HNfyNlwPnCImKe3gni/AbZCTHH3109dIlL5cy2sib5JQK', 0, 3, '', 1, 1623115118),
(6, 'Firnanda', 'firnanda@gmail.com', 'default.jpg', '$2y$10$H7OjBa8mmQ96MU20eCRNh.Ow2PxIOqFqAwEpq1vFTg4elF0YhxVu.', 0, 3, '', 1, 1623115859),
(7, 'Ayu', 'ayu12@gmail.com', 'default.jpg', '$2y$10$03y0TwsrnV7RBQU.8OH.Aeu9zQ1E/gMJG/MZ37wBNc0KjXYttcBd2', 12345, 2, '', 1, 1624245956);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin sekertaris'),
(2, 'admin peribadatan'),
(3, 'member santri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `id_w` int(11) NOT NULL,
  `waktu_p` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`id_w`, `waktu_p`) VALUES
(1, 'Sore'),
(2, 'Malam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biodata_santri`
--
ALTER TABLE `biodata_santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_univ` (`id_univ`),
  ADD KEY `id_angk` (`id_angk`);

--
-- Indeks untuk tabel `data_kamar`
--
ALTER TABLE `data_kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `kamar` (`id_ka`),
  ADD KEY `id_angk` (`id_angk`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `dewan_kyai`
--
ALTER TABLE `dewan_kyai`
  ADD PRIMARY KEY (`id_kyai`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indeks untuk tabel `histori_edit_santri`
--
ALTER TABLE `histori_edit_santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`);

--
-- Indeks untuk tabel `jabatan_ms`
--
ALTER TABLE `jabatan_ms`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jumlah_santri`
--
ALTER TABLE `jumlah_santri`
  ADD PRIMARY KEY (`id_jumlah`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kitab`
--
ALTER TABLE `kitab`
  ADD PRIMARY KEY (`id_kitab`);

--
-- Indeks untuk tabel `madin`
--
ALTER TABLE `madin`
  ADD PRIMARY KEY (`id_ma`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_hari` (`id_hari`);

--
-- Indeks untuk tabel `majelis_santri`
--
ALTER TABLE `majelis_santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `nama_angkatan`
--
ALTER TABLE `nama_angkatan`
  ADD PRIMARY KEY (`id_angk`);

--
-- Indeks untuk tabel `nama_kamar`
--
ALTER TABLE `nama_kamar`
  ADD PRIMARY KEY (`id_ka`);

--
-- Indeks untuk tabel `pengajian`
--
ALTER TABLE `pengajian`
  ADD PRIMARY KEY (`id_ngaji`),
  ADD UNIQUE KEY `id_hari` (`id_hari`),
  ADD KEY `id_kyai` (`id_kyai`),
  ADD KEY `id_w` (`id_w`),
  ADD KEY `id_kitab` (`id_kitab`);

--
-- Indeks untuk tabel `status_santri`
--
ALTER TABLE `status_santri`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `univ`
--
ALTER TABLE `univ`
  ADD PRIMARY KEY (`id_univ`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id_w`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kamar`
--
ALTER TABLE `data_kamar`
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `dewan_kyai`
--
ALTER TABLE `dewan_kyai`
  MODIFY `id_kyai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `histori_edit_santri`
--
ALTER TABLE `histori_edit_santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan_ms`
--
ALTER TABLE `jabatan_ms`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `jumlah_santri`
--
ALTER TABLE `jumlah_santri`
  MODIFY `id_jumlah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `madin`
--
ALTER TABLE `madin`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `majelis_santri`
--
ALTER TABLE `majelis_santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nama_angkatan`
--
ALTER TABLE `nama_angkatan`
  MODIFY `id_angk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `nama_kamar`
--
ALTER TABLE `nama_kamar`
  MODIFY `id_ka` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengajian`
--
ALTER TABLE `pengajian`
  MODIFY `id_ngaji` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `status_santri`
--
ALTER TABLE `status_santri`
  MODIFY `id_status` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `univ`
--
ALTER TABLE `univ`
  MODIFY `id_univ` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id_w` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biodata_santri`
--
ALTER TABLE `biodata_santri`
  ADD CONSTRAINT `biodata_santri_ibfk_1` FOREIGN KEY (`id_angk`) REFERENCES `nama_angkatan` (`id_angk`),
  ADD CONSTRAINT `biodata_santri_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status_santri` (`id_status`),
  ADD CONSTRAINT `biodata_santri_ibfk_3` FOREIGN KEY (`id_univ`) REFERENCES `univ` (`id_univ`);

--
-- Ketidakleluasaan untuk tabel `data_kamar`
--
ALTER TABLE `data_kamar`
  ADD CONSTRAINT `data_kamar_ibfk_1` FOREIGN KEY (`id_ka`) REFERENCES `nama_kamar` (`id_ka`),
  ADD CONSTRAINT `data_kamar_ibfk_2` FOREIGN KEY (`id_angk`) REFERENCES `nama_angkatan` (`id_angk`),
  ADD CONSTRAINT `data_kamar_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status_santri` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `histori_edit_santri`
--
ALTER TABLE `histori_edit_santri`
  ADD CONSTRAINT `histori_edit_santri_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `biodata_santri` (`nis`);

--
-- Ketidakleluasaan untuk tabel `madin`
--
ALTER TABLE `madin`
  ADD CONSTRAINT `madin_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `madin_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `madin_ibfk_3` FOREIGN KEY (`id_hari`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `majelis_santri`
--
ALTER TABLE `majelis_santri`
  ADD CONSTRAINT `majelis_santri_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `biodata_santri` (`nis`),
  ADD CONSTRAINT `majelis_santri_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan_ms` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `pengajian`
--
ALTER TABLE `pengajian`
  ADD CONSTRAINT `pengajian_ibfk_1` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`),
  ADD CONSTRAINT `pengajian_ibfk_2` FOREIGN KEY (`id_kitab`) REFERENCES `kitab` (`id_kitab`),
  ADD CONSTRAINT `pengajian_ibfk_3` FOREIGN KEY (`id_kyai`) REFERENCES `dewan_kyai` (`id_kyai`),
  ADD CONSTRAINT `pengajian_ibfk_4` FOREIGN KEY (`id_w`) REFERENCES `waktu` (`id_w`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
