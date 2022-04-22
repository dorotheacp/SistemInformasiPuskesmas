-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 10:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpuskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `dokterID` int(8) NOT NULL,
  `dokterNama` varchar(255) NOT NULL,
  `dokterPassword` varchar(255) NOT NULL,
  `dokterPoli` varchar(255) NOT NULL,
  `dokterSpesialisasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`dokterID`, `dokterNama`, `dokterPassword`, `dokterPoli`, `dokterSpesialisasi`) VALUES
(1, 'drg. Tina Agustina, Sp.BM', 'rahasiadokter1', 'Gigi', 'Bedah Mulut'),
(2, 'dr. Mira Almira, Sp.PD-KGH', 'rahasiadokter2', 'Penyakit Dalam', 'Ginjal dan Hipertensi'),
(3, 'dr. Odi Parodi, Sp.OG', 'rahasiadokter3', 'Kebidanan Kandungan', 'Obstetri & Ginekologi'),
(4, 'Dra. Sari Sihombing, S.Psi., M.A., Ph.D.', 'rahasiadokter4', 'Psikologi', 'Psikologi'),
(5, 'dr. Kim Junwan, Sp.JP', 'rahasiadokter5', 'Jantung dan Pembuluh Darah', 'Jantung dan Pembuluh Darah'),
(6, 'dr. Lisa Oktarini', 'rahasiadokter6', 'Umum', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalpraktek`
--

CREATE TABLE `jadwalpraktek` (
  `jadwalID` int(8) NOT NULL,
  `dokterID` int(8) NOT NULL,
  `jadwalTglPraktek` date NOT NULL,
  `jadwalJamMulai` time NOT NULL,
  `jadwalJamSelesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwalpraktek`
--

INSERT INTO `jadwalpraktek` (`jadwalID`, `dokterID`, `jadwalTglPraktek`, `jadwalJamMulai`, `jadwalJamSelesai`) VALUES
(1, 1, '2021-12-08', '17:00:00', '22:00:00'),
(2, 2, '2021-12-08', '17:00:00', '22:00:00'),
(6, 3, '2021-12-09', '11:00:00', '17:00:00'),
(7, 4, '2021-12-09', '11:00:00', '17:00:00'),
(8, 5, '2021-12-10', '17:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasienID` int(8) NOT NULL,
  `pasienNama` varchar(255) NOT NULL,
  `pasienPassword` varchar(255) NOT NULL,
  `pasienNamaIbu` varchar(255) NOT NULL,
  `pasienGender` enum('Perempuan','Laki-laki') NOT NULL,
  `pasienGoldar` enum('A','AB','B','O') NOT NULL,
  `pasienTglLahir` date NOT NULL,
  `pasienAlamat` text NOT NULL,
  `pasienPekerjaan` varchar(255) NOT NULL,
  `pasienAgama` varchar(255) NOT NULL,
  `pasienStatusPernikahan` enum('belum menikah','menikah','cerai hidup','cerai mati') NOT NULL,
  `pasienNoTelp` varchar(255) NOT NULL,
  `pasienAsuransi` enum('Pribadi','BPJS-PBI','BPJS-Mandiri','Swasta') NOT NULL,
  `stafPendaftaranID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasienID`, `pasienNama`, `pasienPassword`, `pasienNamaIbu`, `pasienGender`, `pasienGoldar`, `pasienTglLahir`, `pasienAlamat`, `pasienPekerjaan`, `pasienAgama`, `pasienStatusPernikahan`, `pasienNoTelp`, `pasienAsuransi`, `stafPendaftaranID`) VALUES
(1, 'Huening Kai', 'rahasiapasien1', 'Jasmine', 'Laki-laki', 'A', '2002-08-14', 'Tubagus Ismail VII no. 9', 'Karyawan Swasta', 'Islam', 'belum menikah', '081297973378', 'Swasta', 1),
(2, 'Mario Aglio', 'rahasiapasien2', 'Sarminah', 'Laki-laki', 'B', '2002-11-11', 'Yongsan-gu Seoul', 'Mahasiswa', 'Kristen Protestan', 'belum menikah', '0811977007', 'BPJS-Mandiri', 2),
(3, 'Gita Paragita', 'rahasiapasien3', 'Wanda', 'Perempuan', 'O', '1992-12-12', 'Perum. Permata Blok C11 no. 9', 'Karyawan Swasta', 'Kristen Katolik', 'menikah', '085656789999', 'Pribadi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaranID` int(8) NOT NULL,
  `pendaftaranTgl` date NOT NULL,
  `pasienID` int(8) NOT NULL,
  `dokterID` int(8) NOT NULL,
  `dokterNama` varchar(11) CHARACTER SET latin1 NOT NULL,
  `pendaftaranNoAntrian` int(8) NOT NULL,
  `pendaftaranTglKunjungan` date NOT NULL,
  `pendaftaranJamKunjungan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`pendaftaranID`, `pendaftaranTgl`, `pasienID`, `dokterID`, `dokterNama`, `pendaftaranNoAntrian`, `pendaftaranTglKunjungan`, `pendaftaranJamKunjungan`) VALUES
(8, '2021-12-03', 1, 1, 'Choi Soobin', 1, '2021-12-05', '21:33:14'),
(11, '2021-12-04', 2, 1, 'Choi Soobin', 3, '2021-12-03', '19:49:16'),
(12, '2021-12-04', 2, 2, 'Lee Ikjun', 1, '2021-12-07', '19:16:14'),
(13, '2021-12-05', 1, 2, 'Lee Ikjun', 1, '2021-12-25', '12:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `rekammedis`
--

CREATE TABLE `rekammedis` (
  `rekmedNo` int(8) NOT NULL,
  `pasienID` int(8) NOT NULL,
  `rekmedTglKunjungan` date NOT NULL,
  `dokterID` int(8) NOT NULL,
  `rekmedDiagnosis` text NOT NULL,
  `rekmedTindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekammedis`
--

INSERT INTO `rekammedis` (`rekmedNo`, `pasienID`, `rekmedTglKunjungan`, `dokterID`, `rekmedDiagnosis`, `rekmedTindakan`) VALUES
(1, 1, '2021-12-06', 1, 'Gigi bungsunya tumbuh', 'Cabut gigi bungsu'),
(2, 2, '2021-12-07', 1, 'Infeksi', 'Cabut gigi'),
(3, 3, '2021-10-07', 6, 'DBD', 'Cek trombosit');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `resepNo` int(8) NOT NULL,
  `resepTgl` date NOT NULL,
  `dokterID` int(8) NOT NULL,
  `stafFarmasiID` int(8) NOT NULL,
  `pasienID` int(8) NOT NULL,
  `obatKode` int(8) NOT NULL,
  `resepJumlahObat` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`resepNo`, `resepTgl`, `dokterID`, `stafFarmasiID`, `pasienID`, `obatKode`, `resepJumlahObat`) VALUES
(1, '2021-11-10', 6, 1, 3, 1, 6),
(2, '2021-12-03', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staffarmasi`
--

CREATE TABLE `staffarmasi` (
  `stafFarmasiID` int(8) NOT NULL,
  `stafFarmasiNama` varchar(255) NOT NULL,
  `stafFarmasiPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffarmasi`
--

INSERT INTO `staffarmasi` (`stafFarmasiID`, `stafFarmasiNama`, `stafFarmasiPassword`) VALUES
(1, 'Bambang Prakoso', 'rahasiafarmasi1'),
(2, 'Yeni Suyeni', 'rahasiafarmasi2'),
(3, 'Tuti Prastiatuti', 'rahasiafarmasi3');

-- --------------------------------------------------------

--
-- Table structure for table `stafpendaftaran`
--

CREATE TABLE `stafpendaftaran` (
  `stafPendaftaranID` int(8) NOT NULL,
  `stafPendaftaranNama` varchar(255) NOT NULL,
  `stafPendaftaranPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stafpendaftaran`
--

INSERT INTO `stafpendaftaran` (`stafPendaftaranID`, `stafPendaftaranNama`, `stafPendaftaranPassword`) VALUES
(1, 'Antoni Salim', 'rahasiapendaftaran1'),
(2, 'Muhammad Eko', 'rahasiapendaftaran2\r\n'),
(3, 'Abigail Felicia', 'rahasiapendaftaran3');

-- --------------------------------------------------------

--
-- Table structure for table `stokobat`
--

CREATE TABLE `stokobat` (
  `obatKode` int(8) NOT NULL,
  `obatNama` varchar(255) NOT NULL,
  `obatStok` int(8) NOT NULL,
  `obatHarga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stokobat`
--

INSERT INTO `stokobat` (`obatKode`, `obatNama`, `obatStok`, `obatHarga`) VALUES
(1, 'Paracetamol 500 mg 10 Kaplet', 12, '6000.00'),
(2, 'Inpepsa Sirup 100 ml', 6, '89000.00'),
(3, 'Cefafroxil 500 mg 10 Kapsul', 3, '28000.00'),
(4, 'Cerini 10 mg 10 Kaplet', 5, '54000.00'),
(5, 'Astria 4 mg 12 Kapsul', 4, '108500.00'),
(6, 'Apialys Sirup 100 ml', 6, '52500.00'),
(7, 'Rhinos Neo Drops 10 ml', 7, '84800.00'),
(8, 'Vometa FT 10 mg 10 Tablet', 8, '58000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokterID`);

--
-- Indexes for table `jadwalpraktek`
--
ALTER TABLE `jadwalpraktek`
  ADD PRIMARY KEY (`jadwalID`),
  ADD KEY `dokter_id` (`dokterID`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasienID`),
  ADD KEY `stafPendaftaranID` (`stafPendaftaranID`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaranID`),
  ADD KEY `pasien_id` (`pasienID`),
  ADD KEY `dokter_id` (`dokterID`);

--
-- Indexes for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD PRIMARY KEY (`rekmedNo`),
  ADD KEY `dokter_id` (`dokterID`),
  ADD KEY `pasienID` (`pasienID`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resepNo`),
  ADD KEY `obat_kode` (`obatKode`),
  ADD KEY `dokter_id` (`dokterID`),
  ADD KEY `pasien_id` (`pasienID`),
  ADD KEY `staf_farmasi_id` (`stafFarmasiID`);

--
-- Indexes for table `staffarmasi`
--
ALTER TABLE `staffarmasi`
  ADD PRIMARY KEY (`stafFarmasiID`);

--
-- Indexes for table `stafpendaftaran`
--
ALTER TABLE `stafpendaftaran`
  ADD PRIMARY KEY (`stafPendaftaranID`);

--
-- Indexes for table `stokobat`
--
ALTER TABLE `stokobat`
  ADD PRIMARY KEY (`obatKode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `dokterID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwalpraktek`
--
ALTER TABLE `jadwalpraktek`
  MODIFY `jadwalID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `pasienID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `pendaftaranID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rekammedis`
--
ALTER TABLE `rekammedis`
  MODIFY `rekmedNo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `resepNo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffarmasi`
--
ALTER TABLE `staffarmasi`
  MODIFY `stafFarmasiID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stafpendaftaran`
--
ALTER TABLE `stafpendaftaran`
  MODIFY `stafPendaftaranID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stokobat`
--
ALTER TABLE `stokobat`
  MODIFY `obatKode` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwalpraktek`
--
ALTER TABLE `jadwalpraktek`
  ADD CONSTRAINT `jadwalpraktek_ibfk_1` FOREIGN KEY (`dokterID`) REFERENCES `dokter` (`dokterID`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`stafPendaftaranID`) REFERENCES `stafpendaftaran` (`stafPendaftaranID`);

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`pasienID`) REFERENCES `pasien` (`pasienID`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`dokterID`) REFERENCES `dokter` (`dokterID`);

--
-- Constraints for table `rekammedis`
--
ALTER TABLE `rekammedis`
  ADD CONSTRAINT `rekammedis_ibfk_1` FOREIGN KEY (`dokterID`) REFERENCES `dokter` (`dokterID`),
  ADD CONSTRAINT `rekammedis_ibfk_2` FOREIGN KEY (`pasienID`) REFERENCES `pasien` (`pasienID`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`obatKode`) REFERENCES `stokobat` (`obatKode`),
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`dokterID`) REFERENCES `dokter` (`dokterID`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`pasienID`) REFERENCES `pasien` (`pasienID`),
  ADD CONSTRAINT `resep_ibfk_4` FOREIGN KEY (`stafFarmasiID`) REFERENCES `staffarmasi` (`stafFarmasiID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
