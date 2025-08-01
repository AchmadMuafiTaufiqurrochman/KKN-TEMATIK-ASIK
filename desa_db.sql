-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Agu 2025 pada 01.37
-- Versi server: 8.0.42
-- Versi PHP: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aparat`
--

CREATE TABLE `aparat` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aparat`
--

INSERT INTO `aparat` (`id`, `nip`, `name`, `position`, `gender`, `photo`, `created_at`, `updated_at`) VALUES
(3, '6666666669', 'M Syifaul Anam', 'Kades', 'L', 'aparat/T6XYKgqvLX4X3FD9jmqClxn40afhY8SuiJVwFNOw.jpg', '2025-07-30 11:04:03', '2025-07-30 11:04:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `map_locations`
--

CREATE TABLE `map_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `type` enum('balai','pertanian','bunga','posyandu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `map_locations`
--

INSERT INTO `map_locations` (`id`, `name`, `latitude`, `longitude`, `type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Balai Desa Mekar Sari', -7.79560000, 110.36950000, 'balai', 'Kantor pemerintahan desa dan pusat pelayanan masyarakat', 'active', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(2, 'Area Pertanian Utama', -7.79700000, 110.37100000, 'pertanian', 'Lahan pertanian seluas 150 Ha dengan sistem irigasi modern', 'active', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(3, 'Kebun Bunga Sari Indah', -7.79400000, 110.36800000, 'bunga', 'Pusat budidaya bunga potong dan tanaman hias', 'active', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(4, 'Posyandu Melati', -7.79600000, 110.37000000, 'posyandu', 'Pos pelayanan kesehatan terpadu untuk balita dan lansia', 'active', '2025-07-30 10:32:06', '2025-07-30 10:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2024_01_01_000001_create_users_table', 1),
(18, '2024_01_01_000002_create_villagers_table', 1),
(19, '2024_01_01_000003_create_potentials_table', 1),
(20, '2024_01_01_000004_create_videos_table', 1),
(21, '2024_01_01_000005_create_map_locations_table', 1),
(22, '2025_07_08_184626_create_sessions_table', 1),
(23, '2025_07_20_140339_create_cache_table', 1),
(24, '2025_07_29_115230_create_aparats_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potentials`
--

CREATE TABLE `potentials` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('pertanian','bunga') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `potentials`
--

INSERT INTO `potentials` (`id`, `title`, `category`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Pertanian Modern', 'pertanian', 'Mengembangkan teknologi pertanian modern dengan sistem irigasi tetes dan penggunaan pupuk organik untuk hasil panen yang optimal.', 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=800', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(2, 'Budidaya Bunga', 'bunga', 'Spesialisasi budidaya bunga potong dan tanaman hias dengan kualitas ekspor yang telah menembus pasar nasional dan internasional.', 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=800', '2025-07-30 10:32:06', '2025-07-30 10:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vHUAl1LOVMrMZeyGGnIMb40uJPU9JcKOPEbz9TN4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFBIek83cEhaT29yODRGSWxnRDZnZ0ZaakhwY1ZDaXlrV3VLVDJpYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3RlbnRpYWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1754011957);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','viewer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'viewer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@wonokarang.desa.id', NULL, '$2y$12$YeEujf1TVi74T47N50iQJuiVqvd6lTdYfJ96AJaby3ZTeM7xKjloC', 'admin', NULL, '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(2, 'Administrator2', 'admin2@wonokarang.desa.id', NULL, '$2y$12$s9vEhw5/X9gRp3VUdSrIB.YrPyIHvcJzDWYZ5aLuVtgAdTkY53m0u', 'admin', NULL, '2025-07-30 10:32:06', '2025-07-30 10:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('profil','kesehatan','perempuan','pertanian','pemerintahan','pembangunan','kegiatan','pengumuman','berita','umkm','karangtaruna') COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `videos`
--

INSERT INTO `videos` (`id`, `title`, `category`, `video_url`, `thumbnail`, `description`, `duration`, `status`, `views`, `created_at`, `updated_at`) VALUES
(1, 'Profil Desa Mekar Sari 2024', 'profil', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=800', 'Video profil lengkap Desa Mekar Sari menampilkan potensi dan keindahan desa', '8:42', 'published', 12546, '2025-07-29 06:43:16', '2025-07-30 14:24:16'),
(4, 'balap', 'pertanian', 'https://vt.tiktok.com/ZS6mm7agD/', 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800', 'qqqqqq', '5:42', 'published', 0, '2025-07-30 10:32:37', '2025-07-30 10:32:37'),
(5, 'Posyandu', 'kesehatan', 'https://youtube.com/', 'https://www.youtube.com/watch?v=vohnVqU4Q_w', 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa', '5:42', 'published', 0, '2025-07-30 10:57:22', '2025-07-30 10:57:22'),
(6, 'Profile - Desa', 'profil', 'https://www.youtube.com/watch?v=vohnVqU4Q_w', 'https://www.youtube.com/watch?v=vohnVqU4Q_w', 'Video profil lengkap Desa Mekar Sari menampilkan potensi dan keindahan desa', '7:9', 'draft', 0, '2025-07-30 11:26:00', '2025-07-30 11:26:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `villagers`
--

CREATE TABLE `villagers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `villagers`
--

INSERT INTO `villagers` (`id`, `name`, `nik`, `gender`, `birth_date`, `job`, `education`, `rt`, `rw`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Subagyo', '3301012345678901', 'L', '1975-03-15', 'Petani', 'SMA', '01', '01', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(2, 'Siti Rahayu', '3301012345678902', 'P', '1980-07-22', 'Ibu Rumah Tangga', 'SMP', '01', '01', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(3, 'Bambang Setiawan', '3301012345678903', 'L', '1982-11-08', 'Peternak', 'S1', '02', '01', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(4, 'Dewi Kusuma', '3301012345678904', 'P', '1985-04-12', 'Guru', 'S1', '02', '01', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(5, 'Joko Santoso', '3301012345678905', 'L', '1970-09-30', 'Pedagang', 'SMA', '01', '02', '2025-07-30 10:32:06', '2025-07-30 10:32:06'),
(6, 'Nur Hidayati', '3301012345678906', 'P', '1988-01-25', 'Petani Bunga', 'D3', '02', '02', '2025-07-30 10:32:06', '2025-07-30 10:32:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aparat`
--
ALTER TABLE `aparat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aparat_nip_unique` (`nip`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `map_locations`
--
ALTER TABLE `map_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `potentials`
--
ALTER TABLE `potentials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `villagers`
--
ALTER TABLE `villagers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `villagers_nik_unique` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aparat`
--
ALTER TABLE `aparat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `map_locations`
--
ALTER TABLE `map_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `potentials`
--
ALTER TABLE `potentials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `villagers`
--
ALTER TABLE `villagers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
