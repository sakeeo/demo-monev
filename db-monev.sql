-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 08:07 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-monev`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `desas`
--

CREATE TABLE `desas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namadesa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepaladesa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekertaris` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keuangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kaur_umum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasi_pemerintahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kaur_kesejahteraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `fakturs`
--

CREATE TABLE `fakturs` (
  `id` int(11) NOT NULL,
  `nomor` varchar(255) DEFAULT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_bidang_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_06_082635_create_desas_table', 1),
(6, '2022_08_06_082903_create_sumber_anggarans_table', 2),
(7, '2022_08_06_083218_create_bidangs_table', 2),
(8, '2022_08_06_083258_create_sub_bidangs_table', 2),
(9, '2022_08_07_053323_create_kegiatans_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pagu_anggarans`
--

CREATE TABLE `pagu_anggarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` year(4) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pagu_anggaran_details`
--

CREATE TABLE `pagu_anggaran_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pagu_anggaran_id` int(11) NOT NULL,
  `sumber_anggaran_id` int(11) NOT NULL,
  `jumlah` float(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `periode` enum('tahun berjalan','sisa tahun sebelumnya') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` int(11) NOT NULL,
  `rencana_kegiatan_id` int(11) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `nama_suplier` varchar(255) DEFAULT NULL,
  `alamat_suplier` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `tgl_pemesanan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `rencana_kegiatan_id`, `lokasi`, `tgl_mulai`, `tgl_selesai`, `nama_suplier`, `alamat_suplier`, `created_at`, `updated_at`, `desa_id`, `tgl_pemesanan`) VALUES
(1, 5, 'DI DESA', '2022-08-16', '2022-08-16', 'AMIR', 'JL. MANURUKI', '2022-08-16 08:45:50', '2022-08-16 08:45:50', 3, '2022-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_anggarans`
--

CREATE TABLE `realisasi_anggarans` (
  `id` int(11) NOT NULL,
  `pagu_anggaran_id` int(11) DEFAULT NULL,
  `pagu_anggaran_detail_id` int(11) DEFAULT NULL,
  `tanggal1` date DEFAULT NULL,
  `tanggal2` date DEFAULT NULL,
  `tanggal3` date DEFAULT NULL,
  `jumlah1` float(11,2) DEFAULT NULL,
  `jumlah2` float(11,2) DEFAULT NULL,
  `jumlah3` float(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `rencana_kegiatans`
--

CREATE TABLE `rencana_kegiatans` (
  `id` int(11) NOT NULL,
  `kegiatan_id` int(11) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `pagu` float(20,2) DEFAULT NULL,
  `sumber_anggaran_id` int(11) DEFAULT NULL,
  `realisasi` float(11,2) DEFAULT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rencana_kegiatan_header_id` int(11) DEFAULT NULL,
  `path` longtext DEFAULT NULL,
  `pelaksana` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `rencana_kegiatan_header`
--

CREATE TABLE `rencana_kegiatan_header` (
  `id` int(11) NOT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sub_bidangs`
--

CREATE TABLE `sub_bidangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bidang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sumber_anggarans`
--

CREATE TABLE `sumber_anggarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('super','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(6, 'ADMINISTRATOR', 'ADMINISTRATOR', 'superadmin@gmail.com', NULL, '$2y$10$3/1qXohUZBV6j1XFjBuQmesloYTxjePe.RLK2TePPEzCbgQX7chZy', NULL, '2022-08-07 00:32:32', '2022-08-07 00:32:32', 'super'),
(7, 'ANDI', 'Kasir', 'andi@gmail.com', NULL, '$2y$10$UyG0DNRs8QK/iXzqGoLWH.FjOhmlS4Pu.uuREwsITz6XhJwCtppaa', NULL, '2022-08-07 01:58:38', '2022-08-07 01:58:38', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rag`
-- (See below for the actual view)
--
CREATE TABLE `view_rag` (
`pagu_anggaran_id` int(11)
,`jumlah` float(11,2)
,`periode` enum('tahun berjalan','sisa tahun sebelumnya')
,`jumlah1` float(11,2)
,`jumlah2` float(11,2)
,`jumlah3` float(11,2)
,`tahun` year(4)
,`desa_id` int(11)
,`namadesa` varchar(255)
,`kode` varchar(255)
,`uraian` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rkk`
-- (See below for the actual view)
--
CREATE TABLE `view_rkk` (
`pekerjaan` varchar(255)
,`kegiatan_id` int(11)
,`tahun` varchar(255)
,`kegiatan` varchar(255)
,`bidang` varchar(255)
,`pagu` float(20,2)
,`kode` varchar(255)
,`namadesa` varchar(255)
,`realisasi` float(11,2)
,`desa_id` int(11)
,`sumber_anggaran_id` int(11)
,`sub_bidang` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_rag`
--
DROP TABLE IF EXISTS `view_rag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rag`  AS SELECT `pagu_anggaran_details`.`pagu_anggaran_id` AS `pagu_anggaran_id`, `pagu_anggaran_details`.`jumlah` AS `jumlah`, `pagu_anggaran_details`.`periode` AS `periode`, `realisasi_anggarans`.`jumlah1` AS `jumlah1`, `realisasi_anggarans`.`jumlah2` AS `jumlah2`, `realisasi_anggarans`.`jumlah3` AS `jumlah3`, `pagu_anggarans`.`tahun` AS `tahun`, `pagu_anggarans`.`desa_id` AS `desa_id`, `desas`.`namadesa` AS `namadesa`, `sumber_anggarans`.`kode` AS `kode`, `sumber_anggarans`.`uraian` AS `uraian` FROM ((((`pagu_anggaran_details` join `pagu_anggarans` on(`pagu_anggaran_details`.`pagu_anggaran_id` = `pagu_anggarans`.`id`)) join `desas` on(`pagu_anggarans`.`desa_id` = `desas`.`id`)) join `sumber_anggarans` on(`pagu_anggaran_details`.`sumber_anggaran_id` = `sumber_anggarans`.`id`)) join `realisasi_anggarans` on(`pagu_anggaran_details`.`id` = `realisasi_anggarans`.`pagu_anggaran_detail_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_rkk`
--
DROP TABLE IF EXISTS `view_rkk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rkk`  AS SELECT `rencana_kegiatans`.`pekerjaan` AS `pekerjaan`, `rencana_kegiatans`.`kegiatan_id` AS `kegiatan_id`, `rencana_kegiatan_header`.`tahun` AS `tahun`, `kegiatans`.`kegiatan` AS `kegiatan`, `bidangs`.`bidang` AS `bidang`, `rencana_kegiatans`.`pagu` AS `pagu`, `sumber_anggarans`.`kode` AS `kode`, `desas`.`namadesa` AS `namadesa`, `rencana_kegiatans`.`realisasi` AS `realisasi`, `rencana_kegiatan_header`.`desa_id` AS `desa_id`, `rencana_kegiatans`.`sumber_anggaran_id` AS `sumber_anggaran_id`, `sub_bidangs`.`sub_bidang` AS `sub_bidang` FROM ((((((`rencana_kegiatans` join `rencana_kegiatan_header` on(`rencana_kegiatans`.`rencana_kegiatan_header_id` = `rencana_kegiatan_header`.`id`)) join `sub_bidangs`) join `kegiatans` on(`sub_bidangs`.`id` = `kegiatans`.`sub_bidang_id` and `rencana_kegiatans`.`kegiatan_id` = `kegiatans`.`id`)) join `bidangs` on(`kegiatans`.`bidang_id` = `bidangs`.`id`)) join `sumber_anggarans` on(`rencana_kegiatans`.`sumber_anggaran_id` = `sumber_anggarans`.`id`)) join `desas` on(`rencana_kegiatan_header`.`desa_id` = `desas`.`id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakturs`
--
ALTER TABLE `fakturs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakturs`
--
ALTER TABLE `fakturs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
