-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2023 pada 15.00
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azunime`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `episode` int(50) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anime`
--

INSERT INTO `anime` (`id`, `judul`, `episode`, `genre`, `gambar`) VALUES
(1, 'K-On the movie', 1, 'Music', 'k-on.jpg'),
(2, 'Bocchi the Rock', 12, 'Music', 'bocchi.jpg'),
(3, 'One Piece', 1070, 'Action', 'one-piece.jpg'),
(4, 'SPY×FAMILY', 25, 'Action', 'spy-x-family.jpg'),
(5, 'Dr.Stone', 12, 'Advanture', 'dr.stone.jpg'),
(6, 'Tensei Shitara Slime Datta Ken', 24, 'Action', '64bc07648dcbd.jpg'),
(7, 'Oshi no Ko', 12, 'Drama', '64bc0864bc842.jpg'),
(8, 'Steins;Gate', 24, 'Sci-Fi', '64bc0b07768ae.jpg'),
(9, 'Violet Evergarden', 13, 'Drama', '64bc0c202f808.jpg'),
(12, 'Sword Art Online', 25, 'Action', '64bcff0e2d4ca.jpg'),
(13, 'Nichijou', 26, 'Comedy', '64bd00273035f.jpg'),
(15, 'kubo won\'t let me be invisible', 12, 'Romance', '64bd22771b5bd.jpg'),
(16, 'Konosuba', 10, 'Advanture', '64bd4ee1b7ad8.jpg'),
(17, 'Zombie land Saga', 12, 'Music', '64be25d3a1bbf.jpg'),
(18, 'Kaguya-sama wa Kokurasetai', 12, 'Romance', '64be26e676d2d.jpg'),
(21, 'K-On!', 13, 'Music', '64be2a49f2eec.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`id`, `genre`) VALUES
(1, 'Action'),
(2, 'Romance'),
(3, 'Music'),
(4, 'Sci-Fi'),
(5, 'Slice of life'),
(6, 'Comedy'),
(7, 'Advanture'),
(8, 'Sports'),
(9, 'Horror'),
(10, 'Isekai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'ramarfx', 'rama123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
