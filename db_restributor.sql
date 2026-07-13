-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2026 at 08:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restributor`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_07_02_164414_create_pedagangs_table', 1),
(6, '2026_07_02_200000_create_tarifs_table', 1),
(7, '2026_07_03_000000_add_registration_details_to_pedagangs_table', 1),
(8, '2026_07_03_000000_create_tagihans_table', 1),
(9, '2026_07_03_010000_add_nik_to_users_table', 1),
(10, '2026_07_03_072634_add_foto_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedagangs`
--

CREATE TABLE `pedagangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasar_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_lapak` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komoditas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedagangs`
--

INSERT INTO `pedagangs` (`id`, `nama`, `nik`, `telepon`, `email`, `alamat`, `pasar_tujuan`, `jenis_lapak`, `blok`, `komoditas`, `ktp_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pege', '0000000000000000', '081410882927', 'farighaputri@gmail.com', 'tambun', 'Pasar Raya Pusat', 'lesehan', 'A26', 'sayuran', 'ktp/1gX3kV0TiDeIx9RVOuuyxZkr3o35NdUQwQOM2RqO.png', 'Disetujui', '2026-07-02 22:16:29', '2026-07-02 22:16:37'),
(2, 'malik', '1222222222222222', '0879877221312', 'farighaputri@gmail.com', 'tambunnn', 'Pasar Tradisional Barat', 'Tenda', 'A26', 'sayuran', 'ktp/vCDEBy6opvxfvQaJFH6RCefz7oXjDEtQDboMKWS4.png', 'Disetujui', '2026-07-02 23:54:53', '2026-07-02 23:57:12'),
(3, 'makra', '1111111111111111', '0814108829200', 'makra@gmail.com', 'dramaga', 'Pasar Tradisional Barat', 'Los Pasar', 'A90', 'sayuran', 'ktp/a6wXmGlbQVwoSADh2yNOlxOqNudYQ9YP9EbshAr5.png', 'Disetujui', '2026-07-03 00:01:05', '2026-07-03 00:01:11'),
(4, 'puntaas', '5334645342341323', '0879877221312', 'puntas@gmail.com', 'alun alun', 'Pasar Raya Pusat', 'Kios', 'A26', 'sayuran', 'ktp/bPyruUWhO6K61vSmNGmdEQcBA6DwY52jlFUVgMFS.png', 'Disetujui', '2026-07-03 04:09:44', '2026-07-03 04:09:51'),
(5, 'kina', '9823656871236129', '0879877221312', 'kina@gmail.com', 'alunalun', 'Pasar Raya Pusat', 'Los Pasar', 'A90', 'sayuran', 'ktp/HAOwOIrXdeIAJMiLMhSC056dFeyMiouakppQB7N6.png', 'Disetujui', '2026-07-03 04:39:23', '2026-07-03 04:39:37'),
(6, 'cina', '4232554645753453', '0814108829200', 'cina@gmail.com', 'lanaaaaaas', 'Pasar Induk Timur', 'Tenda', 'A26', 'sayuran', 'ktp/PjLV13SbO1JVvt4KVH5s2Al6WZ3zZu8pyM2zpFmN.png', 'Disetujui', '2026-07-03 04:45:07', '2026-07-03 04:45:17'),
(7, 'wisnu', '2352346452342342', '0879877221312', 'wisnu@gmail.com', 'sempur', 'Pasar Induk Timur', 'Tenda', 'A26', 'sayuran', 'ktp/IRi566bqjhZ0UN79tt6Co16Crjm7CvJWwXNXSG1M.png', 'Disetujui', '2026-07-04 04:51:37', '2026-07-04 04:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagihans`
--

CREATE TABLE `tagihans` (
  `id` bigint UNSIGNED NOT NULL,
  `pedagang_id` bigint UNSIGNED NOT NULL,
  `periode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan_tahun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Dibayar',
  `tanggal_bayar` timestamp NULL DEFAULT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihans`
--

INSERT INTO `tagihans` (`id`, `pedagang_id`, `periode`, `bulan_tahun`, `nominal`, `status`, `tanggal_bayar`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, '07-2026', 'Juli 2026', 30000000000, 'Lunas', '2026-07-02 22:23:56', 'QRIS Digital', '2026-07-02 22:22:57', '2026-07-02 22:23:56'),
(2, 2, '07-2026', 'Juli 2026', 60000, 'Belum Dibayar', NULL, NULL, '2026-07-03 00:03:48', '2026-07-03 00:03:48'),
(3, 3, '07-2026', 'Juli 2026', 90000, 'Belum Dibayar', NULL, NULL, '2026-07-03 00:03:48', '2026-07-03 00:03:48'),
(4, 4, '07-2026', 'Juli 2026', 3000000, 'Lunas', '2026-07-03 04:23:48', 'Midtrans (Bank_transfer)', '2026-07-03 04:10:15', '2026-07-03 04:23:48'),
(5, 5, '07-2026', 'Juli 2026', 90000, 'Lunas', '2026-07-03 04:40:42', 'Midtrans (Bank_transfer)', '2026-07-03 04:40:10', '2026-07-03 04:40:42'),
(6, 6, '07-2026', 'Juli 2026', 60000, 'Lunas', '2026-07-03 04:46:17', 'Midtrans (Bank_transfer)', '2026-07-03 04:45:42', '2026-07-03 04:46:17'),
(7, 7, '07-2026', 'Juli 2026', 60000, 'Lunas', '2026-07-04 04:53:45', 'Midtrans (Bank_transfer)', '2026-07-04 04:53:15', '2026-07-04 04:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `tarifs`
--

CREATE TABLE `tarifs` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_lapak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif_per_hari` bigint UNSIGNED NOT NULL,
  `dasar_hukum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tarifs`
--

INSERT INTO `tarifs` (`id`, `jenis_lapak`, `tarif_per_hari`, `dasar_hukum`, `created_at`, `updated_at`) VALUES
(1, 'Kios', 100000, 'Perda No. 12/2024', '2026-07-02 22:14:29', '2026-07-02 22:14:45'),
(2, 'Los Pasar', 3000, 'Perda No. 12/2024', '2026-07-02 22:14:29', '2026-07-02 22:14:29'),
(3, 'Tenda', 2000, 'Perda No. 08/2022', '2026-07-02 22:14:29', '2026-07-02 22:14:29'),
(4, 'lesehan', 1000000000, 'Perda No. 12/2024', '2026-07-02 22:15:54', '2026-07-02 22:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nik`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'pege', 'farighaputri@gmail.com', '0000000000000000', NULL, '$2y$12$QN39DD/7Mk3PsjSFjdLJ0OjSpEi.SE6G2GZTzQ9sDoU6Cb/Fs7b.S', 'profil/pedagang/UN7pb6mMdfs5UsFEhwHVhkE4dVwQCdSoS3yMmHcu.png', 'KQO1xoQug7LkeLyTa68KvOGSRwWLfXm9Dpzz7wfELIRxLtFfSB84qRPyFNbO', '2026-07-02 22:16:37', '2026-07-03 02:28:11'),
(2, 'ADMIN', 'admin@si-retribusi.id', NULL, NULL, '$2y$12$FCMha4ou9cP3GTPsmtcVQOknq6Y5GGp9IVVPJbFDjZI61pVf9pVDy', 'profil/admin/Hy8NLqBHniQvbW1r4xqU8LrpboOC6cdztiKT9l4s.jpg', NULL, '2026-07-02 23:39:56', '2026-07-03 02:29:18'),
(4, 'makra', 'makra@gmail.com', '1111111111111111', NULL, '$2y$12$5I6gY49ZrJV.oWwgizfmxOzop0CWSJL3i77i5NghrAJJAIE8qs8Gi', 'profil/pedagang/8S7cdAcDxOdqPWNUhsPV51v3HMAEtJ0EkPJ6mbzH.png', 'C24iuTLvcqw7Z6HwGotDVZDMLnuFOzysp46HZz71mtGdBqvYJjDr3IzClFnp', '2026-07-03 00:01:11', '2026-07-03 01:42:32'),
(5, 'puntaas', 'puntas@gmail.com', '5334645342341323', NULL, '$2y$12$HM2SqW8/2/FqHNYGIxkxB.X/rebWfo36XQ7sC8JGeU7JN.7Qy5wdy', NULL, NULL, '2026-07-03 04:09:51', '2026-07-03 04:09:51'),
(6, 'kina', 'kina@gmail.com', '9823656871236129', NULL, '$2y$12$DVCtsOt5UzR7AjMi078cweskgst7EoRbBES86me80BuJXVNkhVWce', NULL, NULL, '2026-07-03 04:39:38', '2026-07-03 04:39:38'),
(7, 'cina', 'cina@gmail.com', '4232554645753453', NULL, '$2y$12$20S7AXDQhoVRsEfOj3xSLuuBN9bXCYgX17.QXi4FNcCjzgU07XFV2', 'profil/pedagang/z0GofCQP6UyWfDFre4lvnmm0cdvyeXoP0ujmtq3A.png', 'XElcAKGoXPwPEo5JqShgcbfZo515c44y1TCsdZQfz7HYGOS41SWVOtcXyBgu', '2026-07-03 04:45:17', '2026-07-04 04:01:48'),
(8, 'wisnu', 'wisnu@gmail.com', '2352346452342342', NULL, '$2y$12$yRKhRagScj1AsVxUw6AF2OxGoImbf/oKK/USBr/nT84QWEceOmG0u', 'profil/pedagang/oG9yfKfaUtdYXumsYzlychKq83hWHMiAN1bmIWbc.png', NULL, '2026-07-04 04:51:57', '2026-07-04 04:54:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pedagangs`
--
ALTER TABLE `pedagangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pedagangs_nik_unique` (`nik`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tagihans`
--
ALTER TABLE `tagihans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tagihans_pedagang_id_periode_unique` (`pedagang_id`,`periode`);

--
-- Indexes for table `tarifs`
--
ALTER TABLE `tarifs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tarifs_jenis_lapak_unique` (`jenis_lapak`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pedagangs`
--
ALTER TABLE `pedagangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihans`
--
ALTER TABLE `tagihans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tarifs`
--
ALTER TABLE `tarifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagihans`
--
ALTER TABLE `tagihans`
  ADD CONSTRAINT `tagihans_pedagang_id_foreign` FOREIGN KEY (`pedagang_id`) REFERENCES `pedagangs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
