-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Paź 2019, 00:36
-- Wersja serwera: 10.1.35-MariaDB
-- Wersja PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aplikacja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `Min` int(11) NOT NULL,
  `Max` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `data`
--

INSERT INTO `data` (`id`, `userId`, `Min`, `Max`, `Time`) VALUES
(12, 8, 1, 4, '2019-10-14 20:10:59'),
(17, 8, 2, 66, '2019-10-14 20:38:45'),
(18, 8, 33, 120, '2019-10-14 20:39:05'),
(19, 9, 7, 31, '2019-10-14 21:04:53'),
(20, 13, 10, 100, '2019-10-20 20:57:37'),
(21, 13, 2, 8, '2019-10-20 20:57:42'),
(22, 13, 91, 163, '2019-10-20 20:57:53'),
(23, 13, 1, 44, '2019-10-20 20:58:01'),
(24, 13, 53, 98, '2019-10-20 20:58:08'),
(25, 12, 8, 69, '2019-10-20 21:26:53'),
(26, 12, 2, 52, '2019-10-20 21:27:12'),
(27, 12, 32, 66, '2019-10-20 21:27:22'),
(28, 12, 92, 178, '2019-10-20 21:27:27'),
(29, 12, 92, 99, '2019-10-20 21:27:33'),
(30, 12, 14, 27, '2019-10-20 21:27:39'),
(31, 12, 21, 37, '2019-10-20 21:27:44');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `surname` text COLLATE utf8_polish_ci NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `DateofRegistration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`, `LastLogin`, `DateofRegistration`, `isAdmin`) VALUES
(6, 'Jan', 'Kowalski', 'Jan88', '9e3895cedfa93fc7d6f63cb00ad91d1b', '2019-10-14 19:50:00', '0000-00-00 00:00:00', 0),
(7, 'Tomek', 'Nowak', 'Tomek32', '9e38e8d688743e0d07d669a1fcbcd35b', '2019-10-14 19:50:00', '0000-00-00 00:00:00', 0),
(8, 'Szymon', 'Charubin', 'Szymon112', '9e38e8d688743e0d07d669a1fcbcd35b', '2019-10-14 20:04:07', '0000-00-00 00:00:00', 0),
(9, 'Mateusz', 'Mak', 'Mak21', '0d7fb88db1b061ba9ed2db73f33a2398', '2019-10-20 20:16:11', '2019-10-14 21:26:22', 0),
(10, 'Tomek', 'Domek', 'Domek123', '9cf05bd64893b88faa48ed12feeca016', '2019-10-14 21:35:21', '2019-10-14 21:28:24', 0),
(11, 'Chyba', 'Dziala', 'Chyba', 'a65c96aa994dbfad8806d309c8d0a687', '2019-10-14 21:36:19', '2019-10-14 21:36:10', 0),
(12, 'Marysia', 'Nowak', 'Maria22', '8c3db9217c08fa7fa3d7ac5b3db565af', '2019-10-20 22:16:46', '2019-10-18 15:19:51', 1),
(13, 'Alicja', 'Kot', 'Kot', 'c0d03d2d3e717da54ffdfc8a76c0f089', '2019-10-20 22:35:03', '2019-10-20 20:00:45', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`) USING BTREE;

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
