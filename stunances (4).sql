-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2023 pada 11.17
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stunances`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `nisn`, `tanggal_bayar`, `id_kelas`, `id_tahun_ajaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(4, '842020120004', '2023-07-28', 5, 2, 1500000, '2023-07-27 00:19:56', '2023-07-28 07:04:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dat`
--

CREATE TABLE `dat` (
  `id_dat` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dat`
--

INSERT INTO `dat` (`id_dat`, `nisn`, `tanggal_bayar`, `id_kelas`, `id_tahun_ajaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(5, '842020120004', '2023-07-28', 5, 2, 4000000, '2023-07-27 00:15:48', '2023-07-28 07:00:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `jurusan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'IPA', '2023-06-25 23:25:49', '2023-06-25 23:25:49'),
(2, 'IPS', '2023-06-25 23:26:00', '2023-06-25 23:26:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasur_lemari`
--

CREATE TABLE `kasur_lemari` (
  `id_kasur_lemari` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kasur_lemari`
--

INSERT INTO `kasur_lemari` (`id_kasur_lemari`, `nisn`, `tanggal_bayar`, `id_kelas`, `id_tahun_ajaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(8, '842020120004', '2023-07-28', 5, 3, 200000, '2023-07-27 00:38:44', '2023-07-28 07:05:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_pertahun`
--

CREATE TABLE `kegiatan_pertahun` (
  `id_kegiatan_tahunan` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_pertahun`
--

INSERT INTO `kegiatan_pertahun` (`id_kegiatan_tahunan`, `nisn`, `tanggal_bayar`, `id_kelas`, `id_tahun_ajaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(4, '930709357353', '2023-07-28', 1, 3, 1900000, '2023-07-26 23:52:07', '2023-07-28 06:57:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'B', '2023-06-25 23:23:56', '2023-06-25 23:23:56'),
(5, 'A', '2023-07-26 23:28:56', '2023-07-26 23:28:56'),
(6, 'C', '2023-07-26 23:29:03', '2023-07-26 23:29:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_tabungan`
--

CREATE TABLE `laporan_tabungan` (
  `id_laporan_tabungan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `bulan_laporan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_04_151241_create_spps_table', 1),
(6, '2023_05_04_152058_create_kelas_table', 1),
(7, '2023_05_04_154232_create_tahun_ajarans_table', 1),
(8, '2023_05_04_165941_create_siswas_table', 1),
(9, '2023_05_04_170509_create_pembayarans_table', 1),
(10, '2023_05_23_142701_create_kegiatan_pertahuns_table', 1),
(11, '2023_05_24_064016_create_tanah_bangunans_table', 1),
(12, '2023_05_24_075005_create_laporan_tabungans_table', 1),
(13, '2023_05_31_115347_create_tingkats_table', 1),
(14, '2023_05_31_120244_create_jurusans_table', 1),
(15, '2023_06_01_063109_create_siswa_tahuns_table', 1),
(16, '2023_06_13_153752_create_setor_tabungans_table', 1),
(17, '2023_06_14_070501_create_tarik_tabungans_table', 1),
(18, '2023_07_05_053445_create_rekaps_table', 2),
(19, '2023_07_10_070539_create_dats_table', 3),
(20, '2023_07_10_075025_create_bukus_table', 4),
(21, '2023_07_20_061633_create_kasur_lemaris_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bulan_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `id_spp` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nisn`, `tanggal_bayar`, `bulan_bayar`, `id_kelas`, `id_tahun_ajaran`, `id_spp`, `jumlah_bayar`, `status`, `created_at`, `updated_at`) VALUES
(48, '930709357353', '2023-07-28', 'Januari', 1, 3, 3, 500000, 'unpaid', '2023-07-28 06:43:11', '2023-07-28 06:43:11'),
(49, '842020120004', '2023-07-28', 'januari', 5, 3, 2, 850000, 'unpaid', '2023-07-28 06:43:39', '2023-07-28 06:43:39'),
(50, '930709357353', '2023-07-28', 'Februari', 1, 2, 3, 500000, 'paid', '2023-07-28 06:45:05', '2023-08-04 02:10:39'),
(53, '2003023', '2023-08-02', 'Mei', 5, 5, 2, 850000, 'unpaid', '2023-08-02 00:58:53', '2023-08-02 00:58:53'),
(54, '930709357353', '2023-08-10', 'juni', 1, 5, 2, 850000, 'paid', '2023-08-02 02:14:44', '2023-08-04 02:14:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_setor_tabungan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tarik_tabungan` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekap`
--

INSERT INTO `rekap` (`id`, `id_setor_tabungan`, `id_tarik_tabungan`, `created_at`, `updated_at`) VALUES
(11, 12, NULL, '2023-07-27 02:27:42', '2023-07-27 02:27:42'),
(12, NULL, 8, '2023-07-27 02:30:09', '2023-07-27 02:30:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekapitulasi`
--

CREATE TABLE `rekapitulasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nisn` bigint(20) UNSIGNED NOT NULL,
  `id_buku` bigint(20) UNSIGNED DEFAULT NULL,
  `id_dat` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kasur_lemari` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kegiatan_pertahun` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tanah_bangunan` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_bayar` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekapitulasi`
--

INSERT INTO `rekapitulasi` (`id`, `nisn`, `id_buku`, `id_dat`, `id_kasur_lemari`, `id_kegiatan_pertahun`, `id_tanah_bangunan`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(9, 842020120004, 4, 5, 8, NULL, 2, 7700000, '2023-08-01 04:51:08', '2023-08-01 04:51:08'),
(10, 930709357353, NULL, NULL, NULL, 4, NULL, 1900000, '2023-08-01 04:51:08', '2023-08-01 04:51:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setor_tabungan`
--

CREATE TABLE `setor_tabungan` (
  `id_setor_tabungan` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tingkat` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `setor` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setor_tabungan`
--

INSERT INTO `setor_tabungan` (`id_setor_tabungan`, `nisn`, `id_tingkat`, `id_kelas`, `tanggal`, `setor`, `created_at`, `updated_at`) VALUES
(12, '930709357353', 1, 1, '2023-07-27', '20000.00', '2023-07-27 02:27:42', '2023-07-27 02:27:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `id_spp` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `nis` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `id_tahun_ajaran`, `id_spp`, `id_siswa`, `nis`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
('2003023', 5, 2, 14, '9480348', 'Putri Setiyaningrum', 'balongan', '086956057888', '2023-08-02 00:56:24', '2023-08-02 00:56:24'),
('842020120004', 2, 2, 6, '842667889', 'Salamun Husen Bajri', 'Jl. Letjen Suprapto No.41 Karanganyar Indramayu', '081221112221', '2023-07-19 01:59:48', '2023-07-24 23:41:56'),
('930709357353', 2, 3, 12, '287923', 'Rahma', 'karangmalang, Indramayu', '089507474672', '2023-07-25 01:11:19', '2023-07-25 01:11:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_tahun`
--

CREATE TABLE `siswa_tahun` (
  `id_siswa_tahun` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tingkat` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa_tahun`
--

INSERT INTO `siswa_tahun` (`id_siswa_tahun`, `nisn`, `id_tingkat`, `id_kelas`, `id_tahun_ajaran`, `created_at`, `updated_at`) VALUES
(6, '930709357353', 3, 1, 3, '2023-07-24 23:51:36', '2023-07-25 01:49:03'),
(8, '2003023', 3, 1, 3, '2023-08-03 23:50:46', '2023-08-03 23:50:46'),
(9, '842020120004', 2, 1, 3, '2023-08-03 23:50:55', '2023-08-03 23:50:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id`, `kategori`, `nominal`, `created_at`, `updated_at`) VALUES
(2, 'Mukim', 850000, '2023-06-25 23:24:27', '2023-07-19 23:06:38'),
(3, 'yatim/Piatu', 500000, '2023-06-25 23:24:39', '2023-07-24 23:42:46'),
(5, 'Dhuafa', 500000, '2023-08-03 23:50:06', '2023-08-03 23:50:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(2, '2021/2022', '2023-06-25 23:25:04', '2023-07-26 01:21:02'),
(3, '2022/2023', '2023-07-19 23:07:28', '2023-07-19 23:07:28'),
(5, '2023/2024', '2023-07-26 23:49:01', '2023-07-26 23:49:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanah_bangunan`
--

CREATE TABLE `tanah_bangunan` (
  `id_tanah_bangunan` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tanah_bangunan`
--

INSERT INTO `tanah_bangunan` (`id_tanah_bangunan`, `nisn`, `tanggal_bayar`, `id_kelas`, `id_tahun_ajaran`, `jumlah_bayar`, `created_at`, `updated_at`) VALUES
(2, '842020120004', '2023-07-28', 5, 3, 2000000, '2023-07-27 00:17:59', '2023-07-28 06:59:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarik_tabungan`
--

CREATE TABLE `tarik_tabungan` (
  `id_tarik_tabungan` bigint(20) UNSIGNED NOT NULL,
  `nisn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tingkat` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `tarik` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tarik_tabungan`
--

INSERT INTO `tarik_tabungan` (`id_tarik_tabungan`, `nisn`, `id_tingkat`, `id_kelas`, `tanggal`, `tarik`, `created_at`, `updated_at`) VALUES
(8, '930709357353', 2, 5, '2023-07-27', '5000.00', '2023-07-27 02:30:09', '2023-07-27 02:30:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat`
--

CREATE TABLE `tingkat` (
  `id_tingkat` bigint(20) UNSIGNED NOT NULL,
  `tingkat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tingkat`
--

INSERT INTO `tingkat` (`id_tingkat`, `tingkat`, `created_at`, `updated_at`) VALUES
(1, '10', '2023-06-25 23:25:16', '2023-06-25 23:25:16'),
(2, '11', '2023-06-25 23:25:25', '2023-06-25 23:25:25'),
(3, '12', '2023-06-25 23:25:36', '2023-06-25 23:25:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Yayasan', 'adminyayasan', 'adminyayasan@gmail.com', NULL, '$2y$10$4FqHk6W2Y2q4zeywb/eW2Oh9JpzsTtzUuGayZcUgU5TZMqiwgy9d.', 'admin', NULL, '2023-06-25 23:23:25', '2023-06-25 23:23:25'),
(2, 'Admin Sekolah', 'adminsekolah', 'adminsekolah@gmail.com', NULL, '$2y$10$AYpY67/WahsNQ7P2GRW/T.51e2on/Shw3gFt9hV/VOJ2tTwnorX5W', 'petugas', NULL, '2023-06-25 23:23:25', '2023-06-25 23:23:25'),
(3, 'Siswa', 'siswa', 'siswa@gmail.com', NULL, '$2y$10$MBC1H2ywSJP2crFcSItKy.uifBBdHzBSttpFAVgc0vBM9tF8nmjA.', 'siswa', NULL, '2023-06-25 23:23:25', '2023-06-25 23:23:25'),
(4, 'adies wijayanto', 'adies', 'adies@gmail.com', NULL, '$2y$10$HB/PXSkIeGD9UAtAa0vdeusp1XLXJASEgbhZwRVws4NyDscS5xNWK', 'siswa', NULL, '2023-06-25 23:27:08', '2023-06-25 23:27:08'),
(5, 'Rahmatun Fii Ramadhani', 'rahma', 'rahma@gmail.com', NULL, '$2y$10$pdBfA8fTx0moxILKiRiqw./Jvf9ctgxf.n5nbA7IpfgnHvjPC73/u', 'siswa', NULL, '2023-06-25 23:28:12', '2023-06-25 23:28:12'),
(6, 'Salamun Husen Bajri', 'Salamun', 'Salamun@gmail.com', NULL, '$2y$10$l7aRbzFGMn4sjUuxs4b02OmzbT2Kha6XmSFib/bwgBxOa1kXNYTw.', 'siswa', NULL, '2023-07-19 01:59:47', '2023-07-19 01:59:47'),
(11, 'Gunawan', 'gunawan', 'gunawan@gmail.com', NULL, '$2y$10$.xwg6Kkg.w6MfjWSIRZF.u/TjxA2xSMdeW7eaXlci7ANzxm8c5YhS', 'siswa', NULL, '2023-07-25 01:09:33', '2023-07-25 01:09:33'),
(12, 'Rahma', 'rahma', 'rahmatun@gmail.com', NULL, '$2y$10$vF76TC4EV7K7jsC1zeHfX.3WEAFJAxs0oU1btW2iybzj9NtFzOcWC', 'siswa', NULL, '2023-07-25 01:11:19', '2023-07-25 01:11:19'),
(13, 'Hana Kariska', 'Hana', 'hana@gmail.com', NULL, '$2y$10$maOw9UAJol03aXJ.1Zc8aO7bHa4g0jazOomi9JTSGe8uoP1YQBbIO', 'siswa', NULL, '2023-07-25 22:13:37', '2023-07-25 22:13:37'),
(14, 'Putri Setiyaningrum', 'putri', 'putrisn@gmail.com', NULL, '$2y$10$0qy6BHmMy.dvfYI8lnZ/Tu7gzhjheqFDg5WjGia2mq8maXeoSibVO', 'siswa', NULL, '2023-08-02 00:56:23', '2023-08-02 00:56:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `buku_nisn_foreign` (`nisn`),
  ADD KEY `buku_id_kelas_foreign` (`id_kelas`),
  ADD KEY `buku_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `dat`
--
ALTER TABLE `dat`
  ADD PRIMARY KEY (`id_dat`),
  ADD KEY `dat_nisn_foreign` (`nisn`),
  ADD KEY `dat_id_kelas_foreign` (`id_kelas`),
  ADD KEY `dat_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `kasur_lemari`
--
ALTER TABLE `kasur_lemari`
  ADD PRIMARY KEY (`id_kasur_lemari`),
  ADD KEY `kasur_lemari_nisn_foreign` (`nisn`),
  ADD KEY `kasur_lemari_id_kelas_foreign` (`id_kelas`),
  ADD KEY `kasur_lemari_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `kegiatan_pertahun`
--
ALTER TABLE `kegiatan_pertahun`
  ADD PRIMARY KEY (`id_kegiatan_tahunan`),
  ADD KEY `kegiatan_pertahun_nisn_foreign` (`nisn`),
  ADD KEY `kegiatan_pertahun_id_kelas_foreign` (`id_kelas`),
  ADD KEY `kegiatan_pertahun_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `laporan_tabungan`
--
ALTER TABLE `laporan_tabungan`
  ADD PRIMARY KEY (`id_laporan_tabungan`),
  ADD KEY `laporan_tabungan_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

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
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_nisn_foreign` (`nisn`),
  ADD KEY `pembayaran_id_kelas_foreign` (`id_kelas`),
  ADD KEY `pembayaran_id_tahun_ajaran_foreign` (`id_tahun_ajaran`),
  ADD KEY `pembayaran_id_spp_foreign` (`id_spp`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekapitulasi`
--
ALTER TABLE `rekapitulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekapitulasi_nisn_foreign` (`nisn`) USING BTREE;

--
-- Indeks untuk tabel `setor_tabungan`
--
ALTER TABLE `setor_tabungan`
  ADD PRIMARY KEY (`id_setor_tabungan`),
  ADD KEY `setor_tabungan_nisn_foreign` (`nisn`),
  ADD KEY `setor_tabungan_id_tingkat_foreign` (`id_tingkat`),
  ADD KEY `setor_tabungan_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `siswa_id_tahun_ajaran_foreign` (`id_tahun_ajaran`),
  ADD KEY `siswa_id_spp_foreign` (`id_spp`),
  ADD KEY `siswa_id_siswa_foreign` (`id_siswa`);

--
-- Indeks untuk tabel `siswa_tahun`
--
ALTER TABLE `siswa_tahun`
  ADD PRIMARY KEY (`id_siswa_tahun`),
  ADD KEY `siswa_tahun_nisn_foreign` (`nisn`),
  ADD KEY `siswa_tahun_id_tingkat_foreign` (`id_tingkat`),
  ADD KEY `siswa_tahun_id_kelas_foreign` (`id_kelas`),
  ADD KEY `siswa_tahun_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `tanah_bangunan`
--
ALTER TABLE `tanah_bangunan`
  ADD PRIMARY KEY (`id_tanah_bangunan`),
  ADD KEY `tanah_bangunan_nisn_foreign` (`nisn`),
  ADD KEY `tanah_bangunan_id_kelas_foreign` (`id_kelas`),
  ADD KEY `tanah_bangunan_id_tahun_ajaran_foreign` (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `tarik_tabungan`
--
ALTER TABLE `tarik_tabungan`
  ADD PRIMARY KEY (`id_tarik_tabungan`),
  ADD KEY `tarik_tabungan_nisn_foreign` (`nisn`),
  ADD KEY `tarik_tabungan_id_tingkat_foreign` (`id_tingkat`),
  ADD KEY `tarik_tabungan_id_kelas_foreign` (`id_kelas`);

--
-- Indeks untuk tabel `tingkat`
--
ALTER TABLE `tingkat`
  ADD PRIMARY KEY (`id_tingkat`);

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
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dat`
--
ALTER TABLE `dat`
  MODIFY `id_dat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kasur_lemari`
--
ALTER TABLE `kasur_lemari`
  MODIFY `id_kasur_lemari` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_pertahun`
--
ALTER TABLE `kegiatan_pertahun`
  MODIFY `id_kegiatan_tahunan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `laporan_tabungan`
--
ALTER TABLE `laporan_tabungan`
  MODIFY `id_laporan_tabungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `rekapitulasi`
--
ALTER TABLE `rekapitulasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `setor_tabungan`
--
ALTER TABLE `setor_tabungan`
  MODIFY `id_setor_tabungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `siswa_tahun`
--
ALTER TABLE `siswa_tahun`
  MODIFY `id_siswa_tahun` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tanah_bangunan`
--
ALTER TABLE `tanah_bangunan`
  MODIFY `id_tanah_bangunan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tarik_tabungan`
--
ALTER TABLE `tarik_tabungan`
  MODIFY `id_tarik_tabungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tingkat`
--
ALTER TABLE `tingkat`
  MODIFY `id_tingkat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dat`
--
ALTER TABLE `dat`
  ADD CONSTRAINT `dat_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dat_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dat_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kasur_lemari`
--
ALTER TABLE `kasur_lemari`
  ADD CONSTRAINT `kasur_lemari_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasur_lemari_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasur_lemari_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan_pertahun`
--
ALTER TABLE `kegiatan_pertahun`
  ADD CONSTRAINT `kegiatan_pertahun_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kegiatan_pertahun_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kegiatan_pertahun_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_tabungan`
--
ALTER TABLE `laporan_tabungan`
  ADD CONSTRAINT `laporan_tabungan_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_id_spp_foreign` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekapitulasi`
--
ALTER TABLE `rekapitulasi`
  ADD CONSTRAINT `rekapitulasi_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekapitulasi_id_dat_foreign` FOREIGN KEY (`id_dat`) REFERENCES `dat` (`id_dat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekapitulasi_id_kasur_lemari_foreign` FOREIGN KEY (`id_kasur_lemari`) REFERENCES `kasur_lemari` (`id_kasur_lemari`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `setor_tabungan`
--
ALTER TABLE `setor_tabungan`
  ADD CONSTRAINT `setor_tabungan_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setor_tabungan_id_tingkat_foreign` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id_tingkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setor_tabungan_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_id_spp_foreign` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_tahun`
--
ALTER TABLE `siswa_tahun`
  ADD CONSTRAINT `siswa_tahun_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_tahun_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_tahun_id_tingkat_foreign` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id_tingkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_tahun_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanah_bangunan`
--
ALTER TABLE `tanah_bangunan`
  ADD CONSTRAINT `tanah_bangunan_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanah_bangunan_id_tahun_ajaran_foreign` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanah_bangunan_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tarik_tabungan`
--
ALTER TABLE `tarik_tabungan`
  ADD CONSTRAINT `tarik_tabungan_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarik_tabungan_id_tingkat_foreign` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat` (`id_tingkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarik_tabungan_nisn_foreign` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
