-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2020 pada 18.33
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `harga_beli` float DEFAULT NULL,
  `harga_grosir` float DEFAULT NULL,
  `harga_langganan` float DEFAULT NULL,
  `harga_umum` float DEFAULT NULL,
  `stok_minimal` int(11) DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `id_jenis`, `id_golongan`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_grosir`, `harga_langganan`, `harga_umum`, `stok_minimal`, `expire`, `created_at`, `updated_at`) VALUES
(1, 'Paracethamol Tablet', 1, 1, 1, 2, 100000, 115000, 120000, 125000, 0, '2021-03-13', '2020-12-13 07:24:07', '2020-12-13 07:24:07'),
(2, 'Amoxicilin Injeksi', 2, 1, 1, 5, 200000, 230000, 240000, 250000, 0, '2021-01-09', '2020-12-13 07:25:02', '2020-12-13 07:25:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id` int(11) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id`, `golongan`, `created_at`, `updated_at`) VALUES
(1, 'High Alert', '2020-12-12 12:27:52', '0000-00-00 00:00:00'),
(2, 'Psikotropika', '2020-12-12 12:27:52', '0000-00-00 00:00:00'),
(4, 'Obat Keras', '2020-12-12 07:56:31', '2020-12-12 07:56:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama`, `ket`) VALUES
(1, 'Obat Oral', '-'),
(2, 'Obat Injeksi', '-'),
(3, 'Obat Infus', NULL),
(4, 'Alkes', NULL),
(5, 'BHP', 'Bahan Habis Pakai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, '-'),
(2, 'Non-Formularium'),
(3, 'Formularium');

-- --------------------------------------------------------

--
-- Struktur dari tabel `letak_barang`
--

CREATE TABLE `letak_barang` (
  `id_letak` int(11) NOT NULL,
  `letak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `letak_barang`
--

INSERT INTO `letak_barang` (`id_letak`, `letak`) VALUES
(1, 'Apotek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Ampul', '2020-12-11 20:46:10', NULL),
(2, 'Tablet', '2020-12-11 20:46:10', NULL),
(4, 'Drop', '2020-12-11 13:46:54', '2020-12-11 13:46:54'),
(5, 'CC', '2020-12-11 13:47:23', '2020-12-11 13:47:23'),
(6, 'Box', '2020-12-11 13:49:52', '2020-12-11 13:49:52'),
(7, 'Lembar', '2020-12-11 13:51:10', '2020-12-11 13:51:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `set_harga_jual`
--

CREATE TABLE `set_harga_jual` (
  `id_jenis` int(11) NOT NULL,
  `h_grosir` float DEFAULT NULL,
  `h_langganan` float DEFAULT NULL,
  `h_umum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `set_harga_jual`
--

INSERT INTO `set_harga_jual` (`id_jenis`, `h_grosir`, `h_langganan`, `h_umum`) VALUES
(1, 15, 20, 30),
(2, 15, 20, 30),
(3, 15, 20, 30),
(4, 15, 20, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `set_persentase_jual`
--

CREATE TABLE `set_persentase_jual` (
  `id_persen` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `persen_grosir` float NOT NULL,
  `persen_langganan` float NOT NULL,
  `persen_umum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `set_persentase_jual`
--

INSERT INTO `set_persentase_jual` (`id_persen`, `user_id`, `tgl_input`, `persen_grosir`, `persen_langganan`, `persen_umum`) VALUES
(1, 1, '2020-12-10 03:03:55', 15, 20, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_gudang`
--

CREATE TABLE `stok_gudang` (
  `id_barang` int(11) DEFAULT NULL,
  `id_letak` int(11) DEFAULT NULL,
  `stok` float DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_gudang`
--

INSERT INTO `stok_gudang` (`id_barang`, `id_letak`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2020-12-13 07:24:07', '2020-12-13 14:24:07'),
(2, 1, 0, '2020-12-13 07:25:02', '2020-12-13 14:25:02'),
(NULL, NULL, 0, '2020-12-13 08:33:56', '2020-12-13 15:33:56'),
(NULL, NULL, 0, '2020-12-13 08:34:34', '2020-12-13 15:34:34'),
(NULL, NULL, 0, '2020-12-13 08:53:53', '2020-12-13 15:53:53'),
(NULL, NULL, 0, '2020-12-13 08:53:53', '2020-12-13 15:53:53'),
(NULL, NULL, 0, '2020-12-13 08:53:53', '2020-12-13 15:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@google.com', NULL, '$2y$10$ySboYSJnOD53brTmz.GACuWRr01hlr2gWSND3Qz9tfGcEQaHSaBcu', NULL, '2020-12-04 08:26:37', '2020-12-04 08:26:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_ibfk_3` (`id_kategori`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `barang_ibfk_5` (`id_golongan`),
  ADD KEY `barang_ibfk_6` (`id_satuan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `letak_barang`
--
ALTER TABLE `letak_barang`
  ADD PRIMARY KEY (`id_letak`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `set_harga_jual`
--
ALTER TABLE `set_harga_jual`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `set_persentase_jual`
--
ALTER TABLE `set_persentase_jual`
  ADD PRIMARY KEY (`id_persen`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeks untuk tabel `stok_gudang`
--
ALTER TABLE `stok_gudang`
  ADD KEY `fk_barang_id` (`id_barang`),
  ADD KEY `fk_letak_id` (`id_letak`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `letak_barang`
--
ALTER TABLE `letak_barang`
  MODIFY `id_letak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `set_persentase_jual`
--
ALTER TABLE `set_persentase_jual`
  MODIFY `id_persen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_4` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_ibfk_5` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_ibfk_6` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `set_harga_jual`
--
ALTER TABLE `set_harga_jual`
  ADD CONSTRAINT `set_harga_jual_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`);

--
-- Ketidakleluasaan untuk tabel `set_persentase_jual`
--
ALTER TABLE `set_persentase_jual`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok_gudang`
--
ALTER TABLE `stok_gudang`
  ADD CONSTRAINT `fk_barang_id` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `fk_letak_id` FOREIGN KEY (`id_letak`) REFERENCES `letak_barang` (`id_letak`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
