-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 11, 2026 at 11:02 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alejenews`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `plik` varchar(255) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `czas_trwania` int(11) NOT NULL DEFAULT 5,
  `rodzaj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `plik`, `tytul`, `opis`, `czas_trwania`, `rodzaj`) VALUES
(1, 'domanski.jpg', 'Mikolaj Domanski z srednia 1.0', 'Nikt nie wierzy, ale to prawda. Chlopak placze kazdy w szoku, dyrektor nie wie co zrobic.', 3, 'zdjecie'),
(2, 'bomba.avif', 'Bomba w bolierze', 'Ktos mowil ze w bolierze jest bomba, nikt nie dowierzal a 4 chlopakow na palarni wyjebalo w powietrze', 3, 'zdjecie'),
(3, 'eryczek.jpg', 'Wielka ryba zlowiona przez ucznia Alej AZ 3KG !', 'Ledwo utrzymal w rekach, ale takiego brania dawno nie bylo', 3, 'zdjecie'),
(4, 'dyzio.png', 'Potwor grasuje po Łukowie', 'Prosimy pansta o uwazanie na powyzszego drapieznika, ma okolo 10m wzrostu i zabija spojrzeniem', 5, 'zdjecie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
