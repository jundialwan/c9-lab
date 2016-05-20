-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 03:38 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sifitria_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdBarang` int(11) NOT NULL,
  `NamaBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `JenisBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `SpesifikasiBarang` text COLLATE utf8_unicode_ci NOT NULL,
  `TanggalBeli` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Penanggungjawab` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KategoriBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KondisiBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KeteranganBarang` text COLLATE utf8_unicode_ci,
  `NomorBarcode` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WaktuRegistrasi` timestamp NULL DEFAULT NULL,
  `KerusakanBarang` text COLLATE utf8_unicode_ci,
  `hashBarang` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`created_at`, `updated_at`, `IdBarang`, `NamaBarang`, `JenisBarang`, `SpesifikasiBarang`, `TanggalBeli`, `Penanggungjawab`, `KategoriBarang`, `KondisiBarang`, `KeteranganBarang`, `NomorBarcode`, `WaktuRegistrasi`, `KerusakanBarang`, `hashBarang`) VALUES
('2016-04-14 23:45:59', '2016-04-14 23:45:59', 1, 'Projector 1101', 'Projector', 'Projector untuk ruang kelas 1101', '2016-04-17 09:02:35', 'Sitti Nadindra (Manajer Fasilitas & Infrastruktur)', 'Elektronik', 'Baru', NULL, NULL, NULL, NULL, '61342a80a85e4fc5cd03b43da2e65912'),
('2016-04-14 23:45:59', '2016-04-14 23:45:59', 2, 'Projector 1102', 'Projector', 'Projector untuk ruang kelas 1102', '2016-04-17 09:02:39', 'Sitti Nadindra (Manajer Fasilitas & Infrastruktur)', 'Elektronik', 'Baru', NULL, NULL, NULL, NULL, '39f98d27c67cd73eabe2aaf2af99af64'),
('2016-04-14 23:48:25', '2016-04-14 23:48:25', 3, 'Meja 1101', 'Meja', 'Meja Pengajar untuk ruang kelas 1101', '2016-04-17 09:02:41', 'Sitti Nadindra (Manajer Fasilitas & Infrastruktur)', 'Furnitur', 'Baru', NULL, NULL, NULL, NULL, '27a14c38b040c79511cf6ab47fdd8c83'),
('2016-04-14 23:48:25', '2016-04-14 23:48:25', 4, 'Meja 1102', 'Meja', 'Meja Pengajar untuk ruang kelas 1102', '2016-04-17 09:02:44', 'Sitti Nadindra (Manajer Fasilitas & Infrastruktur)', 'Furnitur', 'Baru', NULL, NULL, NULL, NULL, 'e2c8e486582dbcd99cd619b23f9a6792'),
('2016-04-17 08:37:05', '2016-04-17 08:37:05', 5, 'Asus A46CB', 'Laptop', 'Intel Core i7 6th Gen', '2016-04-17 09:02:12', 'Jundi Ahmad Alwan', 'Elektronik', 'Baru', 'Barang di beli di mangga dua. Sesuai dengan permintaan saudara Bima.', '5', '2016-04-17 01:37:05', 'Tidak ada', '06f794a412cf277effbc3d55ed5e816e'),
('2016-04-17 08:37:05', '2016-04-17 08:37:05', 6, 'Asus ROG', 'Laptop', 'Intel Core i7 6th Gen', '2016-04-17 09:02:21', 'Jundi Ahmad Alwan', 'Elektronik', 'Baru', 'Barang dibeli dari online shop LAZADA', '6', '2016-04-17 01:37:05', 'Barang agak sedikit lecet karena terjatuh saat dibawa.', 'a7887bf42b278196d3dcb59e634edb8f'),
('2016-04-17 09:05:32', '2016-04-17 09:05:32', 7, 'LG LED TV', 'TV', '24" LED', '2016-04-22 17:00:00', 'Bima Satria', 'Elektronik', 'Baru', 'Barang dibeli dari Tokopedia namun masih baru', '7', '2016-04-17 02:05:32', 'Tidak ada', '04830e61fef96e2473d8ebfc7d5dcac4'),
('2016-04-17 10:58:21', '2016-04-17 10:58:21', 8, 'Nokia Lumia 950', 'Smartphone', '5,2" Display\r\nWindows 10 Mobile', '2016-04-22 17:00:00', 'Jundi Ahmad Alwan', 'Elektronik', 'Baru', 'Barang dititipkan ke mas Bima', '8', '2016-04-17 03:58:21', 'Tidak ada', 'ed629d30b31c0d73a486f5c7e210cd74'),
('2016-04-17 10:58:21', '2016-04-17 10:58:21', 9, 'Nokia Lumia 950XL', 'Smartphone', '5,7" Display\r\nWindows 10 Mobile', '2016-05-01 17:00:00', 'Jundi Ahmad Alwan', 'Elektronik', 'Baru', 'Barang dititipkan ke mba Zahra', '9', '2016-04-17 03:58:21', 'Tidak ada', 'de2d5ba0a1bf56121875081b757ba8bc'),
('2016-04-20 09:11:53', '2016-04-20 09:11:53', 10, 'Sofa Panjang', 'asdfasdfasdf', 'dsfasfasf', '2016-05-14 04:51:37', 'Jundi Ahmad Alwan', 'Furnitur', 'Baru', 'sadfasdfa', '10', '2016-04-20 02:11:53', 'Bolong-bolong digigitin kucing', '16e1119625a50949e89299e17d8cc93d'),
('2016-04-20 09:11:53', '2016-04-20 09:11:53', 11, 'asdfasdfa', 'asdfasda', 'asdfasdf', '2016-03-31 17:00:00', 'asdfsadfa', 'Furnitur', 'Baru', 'fffffffff', '11', '2016-04-20 02:11:53', 'asdfafd', 'ebf7b09a7d049ae3b56182784a2e7125'),
('2016-04-20 09:22:13', '2016-04-20 09:22:13', 12, 'Meja', 'Furnitur', 'Meja beli di Gramedia Margonda Depok', '2016-04-11 17:00:00', 'Sekretaris BEM (Mahasiswa 2 - 1300000002)', 'Meja', 'Baru', 'Meja ini digunakan untuk membantu kegiatan kesekretariatan BEM FIA', '12', '2016-04-20 02:22:13', NULL, '733b26e57be78df29914546dae6a6572'),
('2016-05-19 21:31:45', NULL, 13, 'Monitor SAMSUNG', 'Monitor', '14 inch', '2016-05-12 17:00:00', 'Firza Pratama', 'Elektronik', 'Baru', 'Barang merupakan hadiah hasil lomba di bandung minggu lalu', '13', '2016-05-19 21:31:45', NULL, '15060c3816ccc8de3bdf75d1dc8e4984');

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

DROP TABLE IF EXISTS `catatan`;
CREATE TABLE `catatan` (
  `IdPermohonan` int(11) NOT NULL,
  `TahapCatatan` int(11) NOT NULL,
  `DeskripsiCatatan` text COLLATE utf8_unicode_ci,
  `NomorIndukPenulis` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hashCatatan` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`IdPermohonan`, `TahapCatatan`, `DeskripsiCatatan`, `NomorIndukPenulis`, `hashCatatan`, `created_at`, `updated_at`) VALUES
(3, 1, 'Ruangan dipakai dekan untuk rapat', '1306464114', 'ba922c3094b49865f7d6f4ccd945367f', '2016-04-20 03:27:21', '2016-04-20 03:27:21'),
(4, 1, 'Tidak Ada', '1306464114', 'a70e1d5f60f9406acc0831e3cebce254', '2016-04-20 03:09:56', '2016-04-20 03:09:56'),
(5, 1, 'Peminjaman Ruangan harus diajukan minimal satu minggu sebelum acara.', '1306382594', '0fe54d3e05664ac775aa6145493018e5', '2016-04-14 23:49:42', NULL),
(6, 1, 'Peminjaman Ruangan harus diajukan minimal satu minggu sebelum acara.', '1306382594', '6f0debc9851b623b89f1f45da988cc3a', '2016-04-14 23:49:42', NULL),
(10, 0, 'Barang saya beli dari toko furnitur seberang kantor', '1306464114', '2a93345479ed3326d1bda78535d8aea5', '2016-04-17 19:34:59', '2016-04-17 19:34:59'),
(12, 0, 'qwe', '1306464114', 'ca2018512d5687b10f3b7d888d737f59', '2016-04-20 00:20:17', '2016-04-20 00:20:17'),
(13, 0, 'Rapat membutuhkan banyak kursi', '1306464114', '4058ef07f0ed7f5a01ac5dce430283e7', '2016-04-20 03:29:09', '2016-04-20 03:29:09'),
(13, 1, 'permohonan disetujui :)', '1306382594', 'b04d16bd26f26bf29a3bbaa74ccd6a5d', '2016-04-20 08:55:58', '2016-04-20 08:55:58'),
(14, 0, 'asd', '1306464114', 'bb419590b3442b5140cd0f38b066fa7e', '2016-04-20 08:39:56', '2016-04-20 08:39:56'),
(15, 0, '1', '1306464114', '6b6d2c8d2f875bc9e6116aa7860cd28c', '2016-04-20 09:32:54', '2016-04-20 09:32:54'),
(16, 0, 'dosen tidak masuk', '1306464114', 'e721ac975ff65594e70d62eac7f936d4', '2016-04-21 07:57:08', '2016-04-21 07:57:08'),
(17, 0, 'infocus', '1306464114', '4986422ce9eef79fc7adee53a061d07f', '2016-04-21 08:22:48', '2016-04-21 08:22:48'),
(18, 0, 'Barangnya masih ada di ruang Ristek dan belum dibuka dari kardus', '1306464114', '1f2b5816f608094baee4b721644fdcde', '2016-05-02 11:07:28', '2016-05-02 11:07:28'),
(19, 1, 'Terverifikasi', '1306464114', '3d6a454f157b96b450af4cd65bde7b87', '2016-05-07 13:09:52', '2016-05-07 13:09:52'),
(20, 0, 'HP dilindas mobil dekan', '1306464114', '16a3c5401ac3944a3a58a531a47b5ea1', '2016-05-07 08:44:28', '2016-05-07 08:44:28'),
(20, 1, 'Baik, dekan juga sudah mengaku melindas', '1306404632', '60d6a95bc383907c5d1cbd0f6bfec08d', '2016-05-19 22:23:09', NULL),
(20, 2, 'Oke, saya sudah tanya dekan. Beliau tidak sengaja.', '1306464240', '3b3c7df9330e80c79ba4bce0d064dfbd', '2016-05-19 22:51:48', NULL),
(20, 3, 'BIaya nya ditanggung Bu dekan. Disetujui.', '1306464114', 'c0865610765d18b62694b97d8c0d5a3c', '2016-05-19 23:37:19', NULL),
(21, 0, 'Mohon diperbaiki secepatnya karena ingin dipakai dinas', '1306464114', '8ff2100bd980b8579c1c6cb9b8241af3', '2016-05-07 13:11:56', '2016-05-07 13:11:56'),
(21, 1, 'Ditolak. Barang masih mulus gan', '1306464114', '13256d43e1fd38a1d38e1d596edb30c5', '2016-05-07 13:12:36', '2016-05-07 13:12:36'),
(22, 1, 'oke bos', '1306404632', '3e5222fb918a4ac9a0d6be47e1d0927c', '2016-05-19 19:52:52', NULL),
(23, 0, 'Mohon laptopnya dibugkus rapi dan jangan dibuka dahulu', '1306464114', '464a901d2b0a9327d08be9ff413f0bef', '2016-05-07 14:07:24', '2016-05-07 14:07:24'),
(24, 0, 'Mohon segera diperbaiki. Minggu depan ada rektor datang.', '1306464114', '5afa2b2d43574d331e09c931cf12c6ab', '2016-05-07 15:57:13', '2016-05-07 15:57:13'),
(25, 0, 'Mohon segera diperbaiki. Minggu depan ada rektor datang.', '1306464114', '7e1e9a8f6505f31423cb7d0c9b4dc442', '2016-05-07 17:30:55', '2016-05-07 17:30:55'),
(26, 0, 'test doang pak', '1306000001', '3129214cbfa712c5784c57b3703d5393', '2016-05-13 12:28:19', '2016-05-13 12:28:19'),
(26, 1, 'oke gan', '1306382594', '4cb29c88294d5c7201d8ec384d1a1a0b', '2016-05-19 15:30:15', NULL),
(27, 0, 'rusak rusak', '1306000001', 'a197e1e121ae491cf6112e53bdd7bd29', '2016-05-14 04:51:37', '2016-05-14 04:51:37'),
(28, 0, 'rusak rusak', '1306000001', '1bb190cbd0e2feb57cc2d03bd611a8a3', '2016-05-14 06:27:47', '2016-05-14 06:27:47'),
(29, 0, 'wakwawakwawakwawakwawakwawakwaw', '1306000001', '991e3d048290871316d2f254b9ffe7f8', '2016-05-14 08:34:40', '2016-05-14 08:34:40'),
(29, 1, 'iyak, selesai gan', '1301010101', 'a79785adc31a0e638a050761d95dff70', '2016-05-19 21:06:09', NULL),
(30, 0, 'Monitor ada di dalam kardus dekat lemari besi', '1306000001', '72604f6d6a66eb684302eff295abb6dd', '2016-05-18 16:33:01', NULL),
(30, 1, 'terverifikasi', '1306404632', 'b2e15d3c140051326ab9e48d1b1dda7d', '2016-05-19 21:36:57', NULL),
(31, 0, 'ngantuk mz', '1306000001', '92bfbea445fd27dac479bb5b09eca455', '2016-05-19 20:00:14', NULL),
(31, 1, 'mantap gan', '1306404632', '47fb8852bbad31f1479134b1ff4801d4', '2016-05-19 20:02:10', NULL),
(31, 2, 'semangat gan', '1306464240', '8155c106e7033a2a111b1f3da0a3e630', '2016-05-19 20:11:20', NULL),
(31, 3, 'ngopi dulu aja gan', '1306464114', '18a65ae85e2827a6149ad8be3b7c8fa3', '2016-05-19 20:21:12', NULL),
(31, 4, 'sabar ya gan', '1301010101', 'dc1570c0b8235f4c3939556bc9d9cf63', '2016-05-19 20:49:55', NULL),
(31, 5, 'tunggu gan', '1301010101', '1ffc4acc9457254b346c1509327ebf92', '2016-05-19 21:01:15', NULL),
(31, 6, 'Dikiiiiiit lagi', '1301010101', 'a5b9eedb25d87e5bcda9ac6bc5c6468b', '2016-05-19 21:05:03', NULL),
(31, 7, 'kurang satu lagi', '1301010101', 'c0269b2cd61463d39a289fedbfa51f7e', '2016-05-19 21:05:17', NULL),
(31, 8, 'iyak, selesai', '1301010101', '9c1c871b8220a270428d107bfb9d9d71', '2016-05-19 21:08:12', NULL),
(32, 0, 'Komputer dan tablet ada di MIC', '1306000001', '7b3fd64a5f48a306d4288b47e53dff02', '2016-05-19 21:47:46', NULL),
(32, 1, 'oke, barang sudah di cek.', '1306404632', '555b252a6881f9b9b693d01b2834a26e', '2016-05-19 21:51:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

DROP TABLE IF EXISTS `gedung`;
CREATE TABLE `gedung` (
  `IdGedung` int(11) NOT NULL,
  `NamaGedung` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`IdGedung`, `NamaGedung`, `deleted`, `hash`, `created_at`, `updated_at`) VALUES
(1, 'Gedung Y', 0, '137b1cc2182c930f856263d18ae50260', '2016-04-14 01:33:42', '2016-04-14 01:33:42'),
(2, 'Gedung M', 0, 'e0d002a42641132ce53bb30c1e04ff80', '2016-04-14 01:33:43', '2016-04-14 01:33:43'),
(3, 'Gedung Kegiatan Mahasiswa', 1, '870cbd0fe8145c5ca9e3abe81f0446bf', '2016-04-16 03:07:40', '2016-04-16 03:07:40'),
(4, 'Gedung Seminar', 1, 'fbc944b32432f5e0f68c9713fa902b07', '2016-04-16 07:46:20', '2016-04-16 07:46:20'),
(5, 'Gedung X', 1, '781f7e989af45bbb49cb57e76cf38831', '2016-04-20 09:25:18', '2016-04-20 09:25:18'),
(6, 'Gedung Z', 1, 'ef04d9d88ed03e78f73c5c80240a2e4d', '2016-04-21 07:40:55', '2016-04-21 07:40:55'),
(7, 'Gedung A', 1, '22de27c1454cb3e968f8fc0ae9f83b60', '2016-04-21 08:16:36', '2016-04-21 08:16:36'),
(8, 'Gedung Administrasi', 1, 'a039a7d9a50d6385ef3b97dc9516ae4f', '2016-04-22 16:51:17', '2016-04-22 16:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `IdGedung` int(11) NOT NULL,
  `IdRuangan` int(11) NOT NULL,
  `IdJadwal` int(11) NOT NULL,
  `WaktuMulai` timestamp NULL DEFAULT NULL,
  `WaktuSelesai` timestamp NULL DEFAULT NULL,
  `KeperluanPeminjaman` text COLLATE utf8_unicode_ci NOT NULL,
  `hashJadwal` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`IdGedung`, `IdRuangan`, `IdJadwal`, `WaktuMulai`, `WaktuSelesai`, `KeperluanPeminjaman`, `hashJadwal`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-04-18 06:00:00', '2016-04-18 08:00:00', 'Dies Natalis Fakultas Ilmu Administrasi', '698d51a19d8a121ce581499d7b701668', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 1, 2, '2016-04-18 12:30:00', '2016-04-18 14:30:00', 'Grand Launching BEM FIA 2016', '7f6ffaa6bb0b408017b62254211691b5', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 1, 3, '2016-04-20 12:30:00', '2016-04-20 14:30:00', 'Grand Launching DPM FIA 2016', '73278a4a86960eeb576a8fd4c9ec6997', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 1, 4, '2016-04-23 02:00:00', '2016-04-23 10:00:00', 'Training Kependidikan Dosen FIA 2016', '5fd0b37cd7dbbb00f97ba6ce92bf5add', 1, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 2, 1, '2016-04-18 02:00:00', '2016-04-18 03:00:00', 'Rapat Internal Divisi Fasilitas & Infrastruktur', '4c56ff4ce4aaf9573aa5dff913df997a', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 2, 2, '2016-04-18 03:00:00', '2016-04-18 05:00:00', 'Rapat Internal Divisi Pengadaan', 'a0a080f42e6f13b3a2df133f073095dd', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 2, 3, '2016-04-23 03:00:00', '2016-04-23 05:00:00', 'Rapat Perdana BEM FIA 2016', '202cb962ac59075b964b07152d234b70', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 2, 4, '2016-04-23 06:00:00', '2016-04-23 09:00:00', 'Rapat Perdana DPM FIA 2016', 'c8ffe9a587b126f152ed3d89a146b445', 1, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 2, 5, '2016-04-27 01:00:00', '2016-04-27 04:00:00', 'asd', '125', 0, '2016-04-20 08:39:56', '2016-04-20 08:39:56'),
(1, 3, 1, '2016-04-18 02:00:00', '2016-04-18 05:00:00', 'Rapat Internal Staf Sekretariat', '1afa34a7f984eeabdbb0a7d494132ee5', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 3, 2, '2016-04-18 12:00:00', '2016-04-18 14:00:00', 'Rapat BPH BEM FIA', '65ded5353c5ee48d0b7d48c591b8f430', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 3, 3, '2016-04-15 12:00:00', '2016-04-15 14:00:00', 'Rapat BPH BEM FIA', '9fc3d7152ba9336a670e36d0ed79bc43', 0, '2016-04-14 01:47:28', '2016-04-14 01:47:28'),
(1, 4, 1, '2016-04-19 07:30:00', '2016-04-19 09:00:00', 'Kelas Administrasi Bisnis', '0f28b5d49b3020afeecd95b4009adf4c', 1, '2016-04-19 00:44:53', '2016-04-19 00:44:53'),
(1, 5, 1, '2016-04-20 02:00:00', '2016-04-20 02:50:00', 'Kelas Dasar-Dasar Perpajakan', 'a8f15eda80c50adb0e71943adc8015cf', 1, '2016-04-19 00:56:35', '2016-04-19 00:56:35'),
(2, 5, 1, '2016-04-27 01:00:00', '2016-04-27 03:00:00', 'qwerty', '19f3cd308f1455b3fa09a282e0d496f4', 0, '2016-04-20 08:45:05', '2016-04-20 08:45:05'),
(2, 5, 2, '2016-04-26 01:00:00', '2016-04-26 02:00:00', '1', '252', 0, '2016-04-20 09:32:54', '2016-04-20 09:32:54'),
(2, 5, 4, '2016-04-30 01:00:00', '2016-04-30 01:30:00', 'Tes Nadine', 'c52f1bd66cc19d05628bd8bf27af3ad6', 0, '2016-04-20 09:41:47', '2016-04-20 09:41:47'),
(2, 5, 5, '2016-04-27 04:00:00', '2016-04-27 06:30:00', 'kelan Statistik', 'fe131d7f5a6b38b23cc967316c13dae2', 0, '2016-04-21 07:42:38', '2016-04-21 07:42:38'),
(2, 5, 6, '2016-04-30 01:00:00', '2016-04-30 03:00:00', 'kelas penngganti', '256', 0, '2016-04-21 07:57:08', '2016-04-21 07:57:08'),
(3, 3, 2, '2016-04-28 01:00:00', '2016-04-28 04:00:00', 'qwe', 'c042f4db68f23406c6cecf84a7ebb0fe', 1, '2016-04-20 00:20:16', '2016-04-20 00:20:16'),
(3, 3, 3, '2016-04-29 01:00:00', '2016-04-29 04:00:00', 'Dies Natalies FIA UI 2016', '310dcbbf4cce62f762a2aaa148d556bd', 1, '2016-04-20 00:39:02', '2016-04-20 00:39:02'),
(3, 3, 4, '2016-04-28 01:00:00', '2016-04-28 03:00:00', 'Rapat BEM FIA UI', '2f2b265625d76a6704b08093c652fd79', 1, '2016-04-20 03:29:08', '2016-04-20 03:29:08'),
(3, 3, 5, '2016-04-28 01:00:00', '2016-04-28 03:00:00', 'Seminar', 'f9b902fc3289af4dd08de5d1de54f68f', 1, '2016-04-21 08:19:10', '2016-04-21 08:19:10'),
(3, 3, 6, '2016-04-30 01:00:00', '2016-04-30 03:00:00', 'seminar', '336', 1, '2016-04-21 08:22:48', '2016-04-21 08:22:48'),
(3, 3, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rapat BEM', '337', 0, '2016-05-13 12:28:18', '2016-05-13 12:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat_barang`
--

DROP TABLE IF EXISTS `kandidat_barang`;
CREATE TABLE `kandidat_barang` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdKandidatBarang` int(11) NOT NULL,
  `NamaBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `JenisBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KategoriBarang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KeteranganBarang` text COLLATE utf8_unicode_ci NOT NULL,
  `KondisiBarang` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Penanggungjawab` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TanggalBeli` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SpesifikasiBarang` text COLLATE utf8_unicode_ci NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT '0',
  `IdPermohonan` int(11) NOT NULL,
  `hashKandidat` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kandidat_barang`
--

INSERT INTO `kandidat_barang` (`created_at`, `updated_at`, `IdKandidatBarang`, `NamaBarang`, `JenisBarang`, `KategoriBarang`, `KeteranganBarang`, `KondisiBarang`, `Penanggungjawab`, `TanggalBeli`, `SpesifikasiBarang`, `Quantity`, `IdPermohonan`, `hashKandidat`) VALUES
('2016-04-14 09:39:56', '2016-04-14 09:39:56', 1, 'Laptop BEM', 'Elektronik', 'Laptop', 'Laptop ini dipakai untuk kepeluan kesekretariatan BEM FIA. ', 'Baru', 'Ketua BEM (Mahasiswa 1 - 1300000001)', '2016-04-14 09:43:11', 'Laptop ASUS A46CB', 0, 7, ''),
('2016-04-14 09:39:56', '2016-04-14 09:39:56', 2, 'Papan Tulis Ruang BEM', 'Furnitur', 'Papan Tulis', 'Papan Tulis ini digunakan untuk keperluan rapat BEM.', 'Baru', 'Ketua BEM (Mahasiswa 1 - 1300000001)', '2016-04-11 17:00:00', 'Papan Tulis beli di Gramedia Margonda Depok', 0, 8, ''),
('2016-04-14 09:39:56', '2016-04-14 09:39:56', 3, 'Meja', 'Furnitur', 'Meja', 'Meja ini digunakan untuk membantu kegiatan kesekretariatan BEM FIA', 'Baru', 'Sekretaris BEM (Mahasiswa 2 - 1300000002)', '2016-04-11 17:00:00', 'Meja beli di Gramedia Margonda Depok', 0, 9, ''),
('2016-04-17 19:34:59', '2016-04-20 09:14:14', 4, 'Sofa Panjang', 'Kursi Sofa', 'Furnitur', 'dfghj', 'Baru', 'Jundi Ahmad Alwan', '2016-04-11 17:00:00', 'sofa 2 meter', 0, 10, '1b53f59623c8d1efc7951f754f4f8148'),
('2016-04-17 19:34:59', '2016-04-20 09:14:14', 5, 'Sofa Personal', 'Kursi Sofa', 'Furnitur', 'tidak ada', 'Baru', 'Jundi Ahmad Alwan', '2016-04-05 17:00:00', 'sofa untuk 1 orang', 0, 10, 'efe8f853816c42fa2f7f6e014dcee2b6'),
('2016-05-02 11:07:28', '2016-05-02 14:23:56', 6, 'TV', 'TV', 'Elektronik', 'Hasil menang lomba', 'Baru', 'Jundi Ahmad Alwan', '2016-05-01 17:00:00', '24 inch', 0, 18, '503c626159f89ce38044a025f7093942'),
('2016-05-07 14:07:24', '2016-05-08 06:55:07', 7, 'Asus ROG', 'Laptop', 'Elektronik', 'Jangan dibanting. Handle with care.', 'Baru', 'Jundi Ahmad Alwan', '2016-05-07 14:07:24', 'ROG\r\nSpek dewa', 4, 23, '9ddcf76d89f5208a97d438e7a5c37d79'),
('2016-05-14 08:34:40', '2016-05-14 08:34:40', 8, 'ASUS A46CB', 'Laptop', 'Elektronik', 'Barang nya masih mulus', NULL, 'Jundi', '2016-05-14 08:34:40', 'Dewa deh pokoknya', 0, 29, 'f39ef35aad648c2261da2a5d8755b652'),
('2016-05-18 16:33:01', NULL, 9, 'Monitor SAMSUNG', 'Monitor', 'Elektronik', 'Barang merupakan hadiah hasil lomba di bandung minggu lalu', 'Baru', 'Firza Pratama', '2016-05-12 17:00:00', '14 inch', 0, 30, '9879d56ae72844b640e3a580359beca5'),
('2016-05-19 20:00:14', NULL, 10, 'Propensi', 'Mata kuliah', 'Lainnya', 'Insya allah lulus semester ini', NULL, 'Jundi', '0000-00-00 00:00:00', 'Bikin pusing dan ngantuk', 0, 31, 'af565bb9ee7614af409536f2557a8ab0'),
('2016-05-19 21:47:46', NULL, 11, 'PC', 'Komputer', 'Elektronik', 'Barang masih baru dan sudah diinstall di MIC', 'Baru', 'Pak Amril', '2016-04-30 17:00:00', 'RAM 8GB', 0, 32, '4f6df7a177fed5ad1120f05cb1942066'),
('2016-05-19 21:47:46', NULL, 12, 'Tablet Acer Iconia', 'Tablet', 'Elektronik', 'barang masiha ada di kardus', 'Baru', 'Amril', '2016-04-30 17:00:00', 'Acer 12 Inch', 0, 32, 'ac32eb57d8239c4805f8d5e7f6e40651');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_13_105011_create_gedung_table', 1),
('2016_04_13_110657_create_ruangan_table', 1),
('2016_04_13_110750_create_jadwal_table', 1),
('2016_04_13_111631_create_permohonan_table', 1),
('2016_04_13_111742_create_catatan_table', 1),
('2016_04_13_112053_create_kandidat_barang_table', 1),
('2016_04_13_112134_create_barang_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

DROP TABLE IF EXISTS `permohonan`;
CREATE TABLE `permohonan` (
  `IdPermohonan` int(11) NOT NULL,
  `NomorSurat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SubjekPermohonan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IdPemohon` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `JenisPermohonan` int(11) NOT NULL,
  `IdBarang` int(11) DEFAULT NULL,
  `IdGedung` int(11) DEFAULT NULL,
  `IdRuangan` int(11) DEFAULT NULL,
  `IdJadwal` int(11) DEFAULT NULL,
  `LinkAnggaran` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LinkSuratDisposisi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TahapPermohonan` int(11) NOT NULL DEFAULT '1',
  `StatusPermohonan` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `hashPermohonan` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`IdPermohonan`, `NomorSurat`, `SubjekPermohonan`, `IdPemohon`, `JenisPermohonan`, `IdBarang`, `IdGedung`, `IdRuangan`, `IdJadwal`, `LinkAnggaran`, `LinkSuratDisposisi`, `TahapPermohonan`, `StatusPermohonan`, `created_at`, `updated_at`, `deleted`, `hashPermohonan`) VALUES
(1, 'SIFITRIA/2016/04/01', 'Peminjaman Auditorium', '1306000001', 1, NULL, 1, 1, 2, NULL, NULL, 1, 2, '2016-04-14 09:17:08', '2016-04-14 09:17:08', 0, '15b57022e3bf4eb116898ed92e99eedf'),
(2, 'SIFITRIA/2016/04/02', 'Peminjaman Auditorium', '1306000003', 1, NULL, 1, 1, 3, NULL, NULL, 1, 0, '2016-04-14 09:19:39', '2016-04-14 09:19:39', 0, 'ce100643cb931c8e539441845f2c8583'),
(3, 'SIFITRIA/2016/X/05', 'Peminjaman Ruang Rapat Besar', '1306000001', 1, NULL, 1, 2, 3, NULL, NULL, 1, 1, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, 'e5d02116a04736161a1784cb7652bc0d'),
(4, 'SIFITRIA/2016/X/04', 'Peminjaman Ruang Rapat Besar', '1306000003', 1, NULL, 1, 2, 4, NULL, NULL, 1, 2, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, '924c3ee94936465b8d47c54f966247db'),
(5, 'SIFITRIA/2016/04/05', 'Peminjaman Ruang Rapat Kecil', '1306000002', 1, NULL, 1, 3, 2, NULL, NULL, 1, 1, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, '2c03ffd83b0b3598d848da53f66ef6c2'),
(6, 'SIFITRIA/2016/04/06', 'Peminjaman Ruang Rapat Kecil', '1306000004', 1, NULL, 1, 3, 3, NULL, NULL, 1, 1, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, '6f2c6b21ff83bd85f384cd13d5084244'),
(7, 'SIFITRIA/2016/Y/01', 'Registrasi Laptop Baru Sekre', '1306405276', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, 'fbfd05d712aebe8f52c37433d01c9b55'),
(8, NULL, 'Registrasi Barang Papan Tulis untuk Ruang BEM', '1306000001', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, 'c30088da2f6f5ccd55be75d606d5b0a5'),
(9, 'SIFITRIA/2016/X/06', 'Registrasi Barang Meja untuk Ruang BEM', '1306000002', 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, '2016-04-14 09:21:22', '2016-04-14 09:21:22', 0, 'c2329d40c55abfd91dfc76cf92b5beaf'),
(10, NULL, 'Permohonan Registrasi Furnitur', '1306464114', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-04-17 19:34:59', '2016-04-17 19:34:59', 1, 'af4feb5c8877bc9bf17badf06bf6d3f5'),
(12, NULL, 'qwe', '1306464114', 1, NULL, 3, 3, 2, NULL, NULL, 1, 0, '2016-04-20 00:20:16', '2016-04-20 00:20:16', 1, 'b246a9736e0a6ee9e1efaaa680c921db'),
(13, 'SIFITRIA/2016/Y/02', 'Rapat BEM FIA UI', '1306464114', 1, NULL, 3, 3, 4, NULL, NULL, 1, 2, '2016-04-20 03:29:09', '2016-04-20 03:29:09', 1, '5fb21ee723ac1c4bf5d42b19ce57fa8f'),
(14, NULL, 'asd', '1306464114', 1, NULL, 1, 2, 5, NULL, NULL, 1, 0, '2016-04-20 08:39:56', '2016-04-20 08:39:56', 1, '621d4923e96bd556925987517328e121'),
(15, NULL, '1', '1306464114', 1, NULL, 2, 5, 2, NULL, NULL, 1, 0, '2016-04-20 09:32:54', '2016-04-20 09:32:54', 0, 'a8f15eda80c50adb0e71943adc8015cf'),
(16, NULL, 'Kelas pengganti statistik', '1306464114', 1, NULL, 2, 5, 6, NULL, NULL, 1, 0, '2016-04-21 07:57:08', '2016-04-21 07:57:08', 0, 'f70fde6b0e298a917865873f9154d884'),
(17, NULL, 'Seminar', '1306464114', 1, NULL, 3, 3, 6, NULL, NULL, 1, 0, '2016-04-21 08:22:48', '2016-04-21 08:22:48', 1, '4ac3644f31a766b9a2d61563b2bbf0cc'),
(18, NULL, 'Permohonan registrasi barang Ristek', '1306464114', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-05-02 11:07:28', '2016-05-02 11:07:28', 0, '0a4f5ee23688ee939804fcde92c47b87'),
(19, 'SIFITRIA/A/4/001', 'Kerusakan HP dinas', '1306464114', 4, 9, NULL, NULL, NULL, NULL, NULL, 1, 2, '2016-05-07 08:44:21', '2016-05-07 08:44:21', 0, '91f7f9ec93180caabe8f42d0276c171c'),
(20, 'SIFITRIA/X/4/001', 'Kerusakan HP dinas', '1306464114', 4, 8, NULL, NULL, NULL, NULL, NULL, 3, 2, '2016-05-07 08:44:28', '2016-05-07 08:44:28', 0, '30951c317d133908d8d753a0d37b425d'),
(21, 'SIFITRIA/A/4/002', 'Kerusakan HP karena virus', '1306464114', 4, 9, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-05-07 13:11:56', '2016-05-07 13:11:56', 0, '34ee4aec0671434cd44f01112ee3eb51'),
(22, 'SIFITRIA/X/4/001', 'Pengadaan barang ristek', '1306464114', 3, NULL, NULL, NULL, NULL, '', NULL, 1, 2, '2016-05-07 14:07:16', '2016-05-07 14:07:16', 0, '85c76bc643ec8504ee1d750a9e10069e'),
(23, NULL, 'Pengadaan barang ristek', '1306464114', 3, NULL, NULL, NULL, NULL, '', NULL, 1, 0, '2016-05-07 14:07:24', '2016-05-07 14:07:24', 0, '135c25503bad6e3571dea5f3fb535fa1'),
(24, NULL, 'Sofa panjang bolong ', '1306464114', 4, 10, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-05-07 15:57:13', '2016-05-07 15:57:13', 0, '8d9578b8567fd303bf84ac1560aa0ae6'),
(25, NULL, 'Sofa panjang digigitin bolong bolong dadakan lima ratusan', '1306464114', 4, 10, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-05-07 17:30:55', '2016-05-07 17:30:55', 0, '5492d7632d532e9be9516a91d167bc8c'),
(26, 'SIFITRIA/A/4/003', 'Peminjaman ruangan untuk rapat', '1306000001', 1, NULL, 3, 3, 7, NULL, NULL, 1, 2, '2016-05-13 12:28:19', '2016-05-13 12:28:19', 0, '372e60c190928266d07397b729e116c6'),
(27, NULL, 'Sofa rusak', '1306000001', 4, 10, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-05-14 04:51:36', '2016-05-14 04:51:36', 1, '8b265787b5196678a872e46f1bb7cc77'),
(28, NULL, 'Sofa rusak', '1306000001', 4, 10, NULL, NULL, NULL, NULL, NULL, 1, 1, '2016-05-14 06:27:47', '2016-05-14 06:27:47', 0, 'a8141b587b3120cecae6f0d4facbd0c4'),
(29, 'SIFITRIA/X/4/001', 'Pengadaan laptop ristek', '1306000001', 3, NULL, NULL, NULL, NULL, 'qwe', NULL, 4, 5, '2016-05-14 08:34:40', '2016-05-14 08:34:40', 0, 'c39fd64813243d78eed176957007e5e6'),
(30, 'SIFITRIA/A/2/001', 'Registrasi monitor Ristek', '1306000001', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2016-05-18 16:33:01', NULL, 0, '5235c7ab4bb99530aedd774b3bbfb78d'),
(31, 'SIFITRIA/D/4/001', 'H-6 jam gan', '1306000001', 3, NULL, NULL, NULL, NULL, 'mantap', NULL, 4, 5, '2016-05-19 20:00:14', NULL, 0, 'be5f9e5119b59c4dbd8206881be4f4d6'),
(32, 'SIFITRIA/A/2/005', 'Registrasi Elektronik MIC', '1306000001', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2016-05-19 21:47:46', NULL, 0, 'af54ba27a4604e85ee85335f21a3160a');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE `ruangan` (
  `IdGed` int(11) NOT NULL,
  `IdRuangan` int(11) NOT NULL,
  `NomorRuangan` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `KapasitasRuangan` int(11) NOT NULL,
  `JenisRuangan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `hashRuang` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`IdGed`, `IdRuangan`, `NomorRuangan`, `KapasitasRuangan`, `JenisRuangan`, `deleted`, `hashRuang`, `created_at`, `updated_at`) VALUES
(1, 1, '130X', 60, 'Kelas', 0, '20d06d00edc5429e065344602981a1e2', '2016-04-14 01:33:55', '2016-04-14 01:33:55'),
(1, 2, '1201', 20, 'RuangRapatBesar', 0, 'cb2d8dd7b31e4b23aaeec0e6281652c4', '2016-04-14 01:33:55', '2016-04-14 01:33:55'),
(1, 3, '1202', 10, 'RuangRapatKecil', 0, '5a50b95d1debe2ea9d3429aa0d147e18', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 4, '1101', 50, 'Kelas', 0, 'f2765184f53d17c793d7f6aa8269b791', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 5, '1102', 50, 'Kelas', 0, '9088a4e2b81183475a66520168599998', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 6, '1103', 50, 'Kelas', 0, 'ceceb5e882409eba738697c743a32bbd', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 7, '1104', 50, 'Kelas', 0, '1a444d8b6fb0232f7b23ce1656b64b37', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 8, '1105', 50, 'Kelas', 0, '5df789195051cc95d3547c611af0fbdc', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(1, 9, '1105', 50, 'RuangRapatKecil', 0, 'a72db39c85f3bbecd748954682f7d4f4', '2016-04-20 08:49:57', '2016-04-20 08:49:57'),
(1, 10, 'G201', 60, 'Kelas', 0, 'f56e8253b3d8e4d51b710a2a7c10c1e2', '2016-04-21 07:47:46', '2016-04-21 07:47:46'),
(1, 11, '130X', 50, 'Kelas', 1, '6dc1cf02d9fd92d13ea8fb5485bb2069', '2016-05-14 03:21:30', '2016-05-14 03:21:30'),
(1, 12, '130X', 50, 'Kelas', 1, 'cc314eabfd0164e224fa9e660aa5db99', '2016-05-14 03:21:47', '2016-05-14 03:21:47'),
(1, 13, '130X', 50, 'Kelas', 1, '3585db25ce8fb53712a2bf368cab5a38', '2016-05-14 03:24:55', '2016-05-14 03:24:55'),
(1, 14, '130X', 50, 'Kelas', 1, '195ec9780e0b34fa436b20cfaeb7c569', '2016-05-14 03:26:43', '2016-05-14 03:26:43'),
(2, 1, '2201', 50, 'Kelas', 0, '54d7b5f781d09eef3b562eb0186b3706', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(2, 2, '2202', 50, 'Kelas', 0, '97e40869fb381308e41aca217be0fd35', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(2, 3, '2203', 50, 'Kelas', 0, '27d483dc94870b96229f267fe407fb77', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(2, 4, '2204', 50, 'Kelas', 0, 'f177fc886ec1672e026eddb11c90c362', '2016-04-14 01:33:56', '2016-04-14 01:33:56'),
(2, 5, '2205', 50, 'Kelas', 0, '7f035697650a0b1c8a6d0cd810cacc3e', '2016-04-14 01:33:59', '2016-04-14 01:33:59'),
(3, 1, '3101', 20, 'RuangRapatKecil', 1, '949ad7e4ee41c8b2fdac3cade9f5e77e', '2016-04-16 11:28:10', '2016-04-16 11:28:10'),
(3, 2, '3102', 50, 'RuangRapatKecil', 1, '1d4412c5c4c85e05225dad3b95d5ea24', '2016-04-16 11:35:24', '2016-04-16 11:35:24'),
(3, 3, '3103', 300, 'Auditorium', 1, '1c129b852d9c34311f9b7ec1e9607fdd', '2016-04-16 12:04:47', '2016-04-16 12:04:47'),
(7, 1, '1234', 50, 'RuangRapatBesar', 1, '2e2b497cb7d058145cd339ffb372257b', '2016-04-21 08:17:15', '2016-04-21 08:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `NomorInduk` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NoHp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NomorIndukPengelola` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NomorInduk`, `Nama`, `Username`, `Password`, `Role`, `Email`, `NoHp`, `NomorIndukPengelola`, `remember_token`, `created_at`, `updated_at`) VALUES
('1301010101', 'Joko Widodo', 'joko.widodo', 'c295184f1c7e344fe206401e0b4b9ca1', 'Staf Pengadaan', '', '', NULL, NULL, '2016-05-19 20:24:13', NULL),
('1306000001', 'Mahasiswa 1', 'mahasiswa.1', 'c295184f1c7e344fe206401e0b4b9ca1', 'HM', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306000002', 'Mahasiswa 2', 'mahasiswa.2', 'c295184f1c7e344fe206401e0b4b9ca1', 'Mahasiswa', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306000003', 'Mahasiswa 3', 'mahasiswa.3', 'c295184f1c7e344fe206401e0b4b9ca1', 'Mahasiswa', '', '', NULL, NULL, '2016-04-14 01:33:31', '2016-04-14 01:33:31'),
('1306000004', 'Mahasiswa 4', 'mahasiswa.4', 'c295184f1c7e344fe206401e0b4b9ca1', 'Mahasiswa', '', '', NULL, NULL, '2016-04-14 01:33:31', '2016-04-14 01:33:31'),
('1306000005', 'Staf 1', 'staf.1', 'c295184f1c7e344fe206401e0b4b9ca1', 'Staf', '', '', NULL, NULL, '2016-04-14 01:33:31', '2016-04-14 01:33:31'),
('1306382594', 'Bima Satria Surya Wardhana', 'bima.satria', 'c295184f1c7e344fe206401e0b4b9ca1', 'Staf Sekretariat', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306404632', 'Nadya Azizah', 'nadya.azizah', 'c295184f1c7e344fe206401e0b4b9ca1', 'Staf Fasilitas & Infrastruktur', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306405276', 'Zahra Zuluthfa', 'zahra.zuluthfa', 'c295184f1c7e344fe206401e0b4b9ca1', 'Staf PPAA', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306464114', 'Jundi Ahmad Alwan', 'jundi.ahmad', 'c295184f1c7e344fe206401e0b4b9ca1', 'Wakil Dekan 2', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30'),
('1306464240', 'Sitti Nadindra', 'sitti.nadindra', 'c295184f1c7e344fe206401e0b4b9ca1', 'Manajer Fasilitas & Infrastruktur', '', '', NULL, NULL, '2016-04-14 01:33:30', '2016-04-14 01:33:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IdBarang`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`IdPermohonan`,`TahapCatatan`),
  ADD KEY `catatan_nomorindukpenulis_foreign` (`NomorIndukPenulis`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`IdGedung`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`IdGedung`,`IdRuangan`,`IdJadwal`);

--
-- Indexes for table `kandidat_barang`
--
ALTER TABLE `kandidat_barang`
  ADD PRIMARY KEY (`IdKandidatBarang`),
  ADD KEY `kandidat_barang_idpermohonan_foreign` (`IdPermohonan`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`IdPermohonan`),
  ADD KEY `permohonan_idpemohon_foreign` (`IdPemohon`),
  ADD KEY `permohonan_idgedung_idruangan_idjadwal_foreign` (`IdGedung`,`IdRuangan`,`IdJadwal`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`IdGed`,`IdRuangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`NomorInduk`),
  ADD UNIQUE KEY `users_username_unique` (`Username`),
  ADD KEY `users_nomorindukpengelola_foreign` (`NomorIndukPengelola`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `catatan_idpermohonan_foreign` FOREIGN KEY (`IdPermohonan`) REFERENCES `permohonan` (`IdPermohonan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_nomorindukpenulis_foreign` FOREIGN KEY (`NomorIndukPenulis`) REFERENCES `users` (`NomorInduk`) ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_idgedung_idruangan_foreign` FOREIGN KEY (`IdGedung`,`IdRuangan`) REFERENCES `ruangan` (`IdGed`, `IdRuangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kandidat_barang`
--
ALTER TABLE `kandidat_barang`
  ADD CONSTRAINT `kandidat_barang_idpermohonan_foreign` FOREIGN KEY (`IdPermohonan`) REFERENCES `permohonan` (`IdPermohonan`) ON UPDATE CASCADE;

--
-- Constraints for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD CONSTRAINT `permohonan_idgedung_idruangan_idjadwal_foreign` FOREIGN KEY (`IdGedung`,`IdRuangan`,`IdJadwal`) REFERENCES `jadwal` (`IdGedung`, `IdRuangan`, `IdJadwal`),
  ADD CONSTRAINT `permohonan_idpemohon_foreign` FOREIGN KEY (`IdPemohon`) REFERENCES `users` (`NomorInduk`) ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `ruangan_idgedung_foreign` FOREIGN KEY (`IdGed`) REFERENCES `gedung` (`IdGedung`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_nomorindukpengelola_foreign` FOREIGN KEY (`NomorIndukPengelola`) REFERENCES `users` (`NomorInduk`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
