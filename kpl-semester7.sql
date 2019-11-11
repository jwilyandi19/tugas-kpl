-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2019 pada 16.05
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpl-semester7`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ideas`
--

CREATE TABLE `ideas` (
  `id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `content` varchar(128) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ideas`
--

INSERT INTO `ideas` (`id`, `user_id`, `content`, `description`) VALUES
('abw7atwbra87', '1TTHxHObn74C7kI6pIPauWZMEpZ', 'Jason', '100$');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
('1TTHxHObn74C7kI6pIPauWZMEpZ', 'admin', '11231'),
('1TTI2wOd7MdAAeZ6tUT6b1zxoHm', 'admin123', 'admin'),
('1TTIGUBO6xydwMJgR3lSHpCqJKr', 'admin1233', 'admin'),
('1TTIIUwhyLafKI9Y7uMyu3BiWi5', 'admin12333', 'admin'),
('1TTIKcSply7kIItJqI4eFANb0sH', 'admin123333', 'admin'),
('1TTILpGVkOuL91FbPhEg7sORpCl', 'admin1233331', 'aaa'),
('1TTKivMQDAHqW4xGwhPEe5W9F8r', 'admin12334', 'admin'),
('1TTQDDLuQ7inrhIIYIuJVSMrhdg', 'edwinh', 'edwi'),
('1TTQgFsFDWMGOtiYz94XnyIJOhb', 'edwinhar', 'edwin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
