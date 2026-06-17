-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 11, 2026 at 02:47 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

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
  `czas_trwania` int(11) NOT NULL DEFAULT 10,
  `rodzaj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `plik`, `tytul`, `opis`, `czas_trwania`, `rodzaj`) VALUES
(1, 'pomnik.jpg', '93. rocznica odsłonięcia pomnika Henryka Sienkiewicza', '28 maja br. minęła 93. rocznica odsłonięcia pomnika Henryka Sienkiewicza w Łukowie – wybitnego pisarza, laureata Nagrody Nobla oraz patrona naszej szkoły.', 10, 'zdjecie'),
(2, 'wizytaPalac.jpg', 'Wizyta w pałacu króla Jana III w Wilanowie', 'Uczniowie klas pierwszych o profilu elektryk, informatyk i mechatronik we wtorek, 9 czerwca 2026 roku, odwiedzili Muzeum Króla Jana III w Wilanowie.', 10, 'zdjecie'),
(3, 'hazardNieDajSie.jpg', 'Hazard? Nie daj się wciągnąć!', 'Dnia 29 maja uczniowie klasy 4Tia, 2Tps, 2Wb wzięli udział w ogólnopolskiej akcji edukacyjnej zorganizowanej przez Krajową Administrację Skarbową pod honorowym patronatem Ministerstwa Edukacji.', 10, 'zdjecie'),
(4, 'konkursHistoriaZiemiLukowskiej.jpg', 'Konkurs „Historia Ziemi Łukowskiej”', '23.04 o godzinie 10.00 odbył się szkolny etap Konkursu „Historia Ziemi Łukowskiej”. Organizatorem konkursu jest Młodzieżowa Rada Powiatu Łukowskiego', 10, 'zdjecie'),
(5, '3majaAkademia.jpg', 'Akademia z okazji Święta Konstytucji 3 Maja', '30 kwietnia w naszej szkole odbyła się uroczysta akademia z okazji 235. rocznicy uchwalenia Konstytucji 3 Maja', 10, 'zdjecie'),
(6, 'rajd3maj.jpg', 'Rajd 3-Majowy', '28 kwietnia odbył się IX Pieszy Rajd 3-Majowy Szkół Ponadpodstawowych Powiatu Łukowskiego. Naszą szkołę reprezentowali uczniowie klasy 2Tps', 10, 'zdjecie'),
(7, 'konkursMotoryzacyjny.jpg', 'Konkurs motoryzacyjny', 'W dniu 23.04.2026 w naszej szkole odbyły się Eliminacje Powiatowe Turnieju „Bezpieczeństwo w Ruchu Drogowym”.', 10, 'zdjecie'),
(8, 'zakonczenie5klas.jpg', 'Zakończenie roku szkolnego klas 5 technikum', 'Są takie chwile w szkole, których nie da się powtórzyć. „Nic dwa razy się nie zdarza…” - jak napisała Wisława Szymborska. Tak było w piątek, 24 kwietnia.', 10, 'zdjecie'),
(9, 'kuzniaTalentow.jpg', 'Nasi Stypendyści Lubelskiej Kuźni Talentów', 'W trakcie gali nasi stypendyści: Julia Rola kl. 5Te, Kacper Rola kl. 5Tp, Artem Prykhoda kl. 4Tp, Jakub Pietrzak kl. 4Tel i Mikołaj Domański kl. 3Tp odebrali dyplomy uznania', 10, 'zdjecie');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
