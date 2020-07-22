-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2020 at 02:15 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakadsmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int(10) NOT NULL,
  `nama_kelas` int(2) NOT NULL,
  `sub_kelas` varchar(2) NOT NULL,
  `access_nilai` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `nama_kelas`, `sub_kelas`, `access_nilai`) VALUES
(1, 7, 'A', 'YES'),
(2, 7, 'B', 'NO'),
(3, 7, 'C', 'NO'),
(4, 7, 'D', 'NO'),
(5, 7, 'E', 'NO'),
(6, 8, 'A', 'NO'),
(7, 8, 'B', 'NO'),
(8, 8, 'C', 'NO'),
(9, 8, 'D', 'NO'),
(10, 8, 'E', 'NO'),
(11, 9, 'A', 'NO'),
(12, 9, 'B', 'NO'),
(13, 9, 'C', 'NO'),
(14, 9, 'D', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_kelas`
--

CREATE TABLE `tb_detail_kelas` (
  `id_detail_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_kelas`
--

INSERT INTO `tb_detail_kelas` (`id_detail_kelas`, `id_guru`, `id_kelas`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(20) NOT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `nign` varchar(20) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `j_kelamin` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  `alamat_guru` text NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nign`, `nama_guru`, `agama`, `j_kelamin`, `tempat_lahir`, `tgl_lahir`, `pendidikan`, `tugas`, `alamat_guru`, `id_mapel`, `password`, `image`) VALUES
(1, 2147483647890, '12030', 'SUHARYATI, S.Pd', 'ISLAM', 'PEREMPUAN', 'SIDOARJO', '1978-09-11', 'SARJANA 1', 'GURU MAPEL', 'JL. PATTIMURA NO 7 SURABAYA', 1, '83a87e5f2e50ddd11747e70374e395900d7f4803', 'hayasaka.jpg'),
(2, 345555443333, '12040', 'SUPARMI, S.Pd', 'ISLAM', 'PEREMPUAN', 'SIDOARJO', '1980-08-09', 'SARJANA 1', 'GURU MAPEL', 'JL. PATTIMURA', 2, '831c2c5bde0f5dcc256bef6f6095e4fe5df1e28f', 'default.jpg'),
(3, NULL, '23457', 'SUPRIYADI', 'ISLAM', 'LAKI LAKI', 'SIDOARJO', '1988-07-07', 'DIPLOMA 1', 'ADMINISTRATOR', 'JL. PATTIMURA NO 1', 0, '743cbc40f3a66857091d82207901a6815f1af54b', 'saba.png'),
(4, 20001992882828, '12240', 'RUDI HASAN, S.Pd', 'ISLAM', 'LAKI LAKI', 'SIDOARJO', '1988-07-06', 'SARJANA 1', 'GURU MAPEL', 'JL. KI HAJAR DEWANTORO', 3, '2eaec43984794b6ff83df317a24bf37a92bac44f', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Matematika'),
(2, 'B. Indonesia'),
(3, 'B. Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(20) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_mapel` int(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `nilai_1` int(11) DEFAULT NULL,
  `nilai_2` int(11) DEFAULT NULL,
  `nilai_3` int(11) DEFAULT NULL,
  `nilai_4` int(11) DEFAULT NULL,
  `nilai_5` int(11) DEFAULT NULL,
  `nilai_6` int(11) DEFAULT NULL,
  `id_guru` int(20) NOT NULL,
  `status_nilai` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_siswa`, `id_mapel`, `id_kelas`, `semester`, `nilai_1`, `nilai_2`, `nilai_3`, `nilai_4`, `nilai_5`, `nilai_6`, `id_guru`, `status_nilai`) VALUES
(1, 1, 2, 1, 'GANJIL', 70, 80, 80, 75, 76, 81, 2, 'NON AKTIF'),
(2, 1, 2, 1, 'GENAP', 70, 81, 78, 76, 78, 81, 2, 'NON AKTIF'),
(3, 1, 2, 8, 'GANJIL', 70, 81, 88, 85, 86, 90, 2, 'NON AKTIF'),
(4, 1, 1, 1, 'GANJIL', 70, 87, 78, 67, 96, 90, 1, 'NON AKTIF'),
(5, 12, 1, 1, 'GANJIL', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AKTIF'),
(6, 14, 1, 1, 'GANJIL', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AKTIF'),
(7, 15, 1, 1, 'GANJIL', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AKTIF'),
(8, 17, 1, 1, 'GANJIL', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` bigint(20) NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `j_kelamin` varchar(40) NOT NULL,
  `tmp_lahir` varchar(40) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nama_ayah` varchar(200) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `telp_ortu` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `agama` varchar(40) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `status_siswa` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nisn`, `nama_siswa`, `j_kelamin`, `tmp_lahir`, `tgl_lahir`, `nama_ayah`, `nama_ibu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `agama`, `alamat_siswa`, `id_kelas`, `status_siswa`, `password`, `image`) VALUES
(1, 2019098908, 'YUNITA SARI', 'PEREMPUAN', 'SIDOARJO', '2006-07-15', 'RUDI HARIADI', 'SITI MAIMUNAH', '08979088796', 'KARY. SWASTA', 'IBU RUMAH TANGGA', 'ISLAM', 'Jl. Mayjend Sungkono', 8, 'AKTIF', '80a010bfe9b22867b5fc0c697a6b30742e3f0b3b', 'saba1.png'),
(2, 2019293489, 'ALIYUDDIN AL GHASALI', 'LAKI LAKI', 'SIDOARJO', '2005-08-09', 'HARI BUDIMAN', 'JUWARIYAH', '08213456783', 'TNI', 'GURU', 'ISLAM', 'Jl. Pattimura No. 9', 2, 'AKTIF', '70fdeeeb150eb710cc176103b9ed954d5b9b28ff', 'default.jpg'),
(3, 234567899, 'DAVID ANDREAN', 'LAKI LAKI', 'SIDOARJO', '2005-07-07', 'SUPARSONO', 'MUSDALIFAH', '085850995467', 'KARY. SWASTA', 'IBU RUMAH TANGGA', 'ISLAM', 'JL. TEUKU UMAR NO 123', 3, 'AKTIF', '0fd2128d3912999c2f907163176b52133eda84cd', 'default.jpg'),
(4, 123456778, 'ANDI FUAD DAMRONI', 'LAKI LAKI', 'SIDOARJO', '2004-07-14', 'KRISTANTO', 'IRVA YOLANDA', '087689765679', 'PNS', 'PNS', 'BUDHA', 'Jl. SINGO EDAN NO 8', 4, 'AKTIF', '30c09d1ac0ed444b86572aff49778c7bc4cfcfbb', 'default.jpg'),
(5, 78998900001, 'ARIF RAHMAN', 'LAKI LAKI', 'SURABAYA', '2004-07-01', 'AHMAD SUTRISNA', 'MUSDALIFAH KURNIA', '082145678948', 'TNI AD', 'PNS', 'ISLAM', 'JL. TEUKU UMAR NO 12', 5, 'AKTIF', 'b634fc4f055df05d733bfd01c450fe1a54ee5fd0', 'default.jpg'),
(6, 78906788772, 'SINTA DWI KURNIA', 'PEREMPUAN', 'SIDOARJO', '2004-09-09', 'SUBAGYO', 'SITI KHOMARIYAH', '08122393993', 'WIRASWASTA', 'IBU RUMAH TANGGA', 'ISLAM', 'JL. TEUKU UMAR NO 21', 6, 'AKTIF', '138a71e42467a83783483e2a338d7d015c8665cd', 'default.jpg'),
(7, 123567890, 'FUAD ADI WIBOWO', 'LAKI LAKI', 'SIDOARJO', '2004-07-01', 'SUPANGKAT', 'SUPINAH', '08777689978', 'PENGUSAHA', 'PNS', 'ISLAM', 'JL. TEUKU UMAR', 7, 'AKTIF', '11b730ae8337329ad82603e5f6f31eda371cd6e6', 'default.jpg'),
(8, 345667890011, 'SUPRIYADI HARYANTO', 'LAKI LAKI', 'SIDOARJO', '2001-09-09', 'M. SUBAKTIO', 'SINTA WULANDARI', '081223939111', 'SUPIR', 'SWASTA', 'ISLAM', 'JL. PATTIMURA NO 12', 11, 'ALUMNI', 'a039c594015cf9be36320ee220925d91af121129', 'default.jpg'),
(9, 20010010109, 'MOH. ABDUL GHONI', 'LAKI LAKI', 'SIDOARJO', '2004-07-01', 'M. BACKTIAR', 'MAESAROH', '081234578922', 'SWASTA', 'GURU', 'ISLAM', 'JL. JAYA RAHARJO NO 8', 9, 'AKTIF', 'b54a8bdc4fe3233a96e05815c4d11c1b958298de', 'default.jpg'),
(10, 12389067544, 'M. ABDUL AZIZ', 'LAKI LAKI', 'SIDOARJO', '2004-09-09', 'MUHAMMAD DANI RAMDAN', 'RAHMAWATI EKA', '08213458790', 'SWASTA', 'GURU', 'ISLAM', 'JL. PATTIMURA NO 12', 10, 'AKTIF', '20eecc227bb06c899931bd7e9b0e00c992f85d64', 'default.jpg'),
(11, 345678900111, 'ABURRAHMAN WAHID', 'LAKI LAKI', 'SIDOARJO', '2004-07-02', 'SUEB', 'FATIMAH', '08977771102', 'SWASTA', 'SWASTA', 'ISLAM', 'JL. UNTUNG SUROPATI', 11, 'ALUMNI', 'd3f6628053940d127be38e4e0d777d8933cad996', 'default.jpg'),
(12, 12345667890, 'ANDRI SYAIFUL HAKIM', 'LAKI LAKI', 'SIDOARJO', '2004-07-01', 'AHMAD JUNAIDI', 'SANTI DWI YULIA', '0876562112233', 'KARY SWASTA', 'IBU RUMAH TANGGA', 'ISLAM', 'JL. SOKO MANUNGGAL NO 2', 1, 'AKTIF', '6edd1e3a25dcf2baab386ca07f8678d2783f449e', 'default.jpg'),
(14, 12456782, 'RUBEN CHRISTOPHER', 'LAKI LAKI', 'SIDOARJO', '2005-11-09', 'HENDRA CHRISTOPER', 'ELIZABETH GRANADELLA', '082145789090', 'PEGAWAI SWASTA', 'PNS', 'PROTESTAN', 'JL. TEUKU UMAR NO 2', 1, 'AKTIF', 'de55615cce52bb2216f513b8b7ae0e1429c91c44', 'default.jpg'),
(15, 124567821, 'AHMAD SALOSSA', 'LAKI LAKI', 'SIDOARJO', '2004-11-01', 'MUSA SUTRISNA', 'DINA HARTATI', '082145789022', 'KARY SWASTA', 'IBU RUMAH TANGGA', 'ISLAM', 'JL. IMAM BONJOL NOMOR 2', 1, 'AKTIF', '6665a2fd4303f070302ee70bac13fb95d19cd046', 'default.jpg'),
(17, 1245678, 'RATIH DWI MAHARANI', 'PEREMPUAN', 'SIDOARJO', '2004-11-02', 'Subagyo', 'WULAN SRI ASTUTI', '082145789090', 'SUPIR', 'PNS', 'ISLAM', 'JL. RADEN AJENG KARTINI NO 2', 1, 'AKTIF', 'd1cdaf521cd7147aac5c83692432a5505bfa936e', 'default.jpg'),
(18, 34789092, 'SULISTYO RUBEN SADIGAR', 'LAKI LAKI', 'SURABAYA', '2004-11-01', 'CHRIS HENDRA JUNAEDI', 'EMANUELLA VIRGINITA', '082145678949', 'PNS', 'PNS', 'KATOLIK', 'JL. MAGUWOHARJO NO 12', 2, 'AKTIF', 'b2c31c491f4ebe88858cce3665d840caa59ddc0c', 'default.jpg'),
(20, 1200019292, 'RAFAEL', 'LAKI LAKI', 'SIDOARJO', '2005-12-02', 'SANTIAGO', 'ELIZABETH', '0821457893456', 'MANAGER', 'IBU RUMAH TANGGA', 'ISLAM', 'JL. SOEKARNO - HATTA NO 1', 4, 'AKTIF', '47f212c5dbda4e571434b0d1e60de55ea263a92b', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_detail_kelas`
--
ALTER TABLE `tb_detail_kelas`
  ADD PRIMARY KEY (`id_detail_kelas`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_detail_kelas`
--
ALTER TABLE `tb_detail_kelas`
  MODIFY `id_detail_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
