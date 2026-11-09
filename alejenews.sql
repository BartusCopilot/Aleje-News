-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 09, 2026 at 07:26 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

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
(1, '1029b.jpg', '11 Listopada: Dzień, w którym Polska wrócila na mapę!', 'Upamiętnia odzyskanie przez Polskę niepodległości w 1918 roku, po 123 latach zaborów. Tego dnia – wraz z zakończeniem I wojny światowej – Polska powróciła na mapę świata, a Józef Piłsudski przejął władzę nad odradzającym się państwem. Świętujemy go, wywieszając biało-czerwone flagi i biorąc udział w uroczystościach.', 20, 'zdjecie'),
(2, '', '', '', 15, 'pytanie_testowe'),
(3, 'dp4.jpg', 'Diecezjalna Pielgrzymka Maturzystów', '21 października uczniowie klas 5Tia i 5Tel, wraz z wychowawcami: p. Beatą Kuczyńską, p. Ingą Bartosiewicz, p. Wiolettą Ponikowską oraz siostrą Małgorzatą Prokopiuk, uczestniczyli w Diecezjalnej Pielgrzymce Maturzystów do Sanktuarium Matki Boskiej Nieustającej Pomocy w Radzyniu Podlaskim.', 15, 'zdjecie'),
(4, '', '', '', 15, 'pytanie_testowe'),
(5, 'zdjecie-1-1024x684.jpg', 'Kolejny sukces Mikołaja Lemiecha', '30 października 2026 r. w Muzeum Sił Zbrojnych w Dęblinie odbył się II Dębliński Festiwal Poezji im. Marii Pawlikowskiej-Jasnorzewskiej, gromadząc 48 uczestników z całego regionu. Z dumą informujemy, że Mikołaj Lemiech z naszej szkoły zdobył II miejsce w kategorii poezji śpiewanej, zachwycając jury m.in. interpretacją „Elegii o chłopcu polskim”.', 15, 'zdjecie'),
(6, '', '', '', 15, 'pytanie_testowe'),
(7, 'IMG20260915121506-1.jpg', 'Uczniowie naszej szkoły wzięli udział w kampanii „BohaterON”!', '15 września br. klasy 5Tia, 3Km oraz uczniowie z 4Th i 2Km włączyli się w projekt „BohaterON w Twojej Szkole”. Tegoroczna edycja przybliżyła młodzieży historię Haliny Rogozińskiej „Małej” – łączniczki z Powstania Warszawskiego.', 15, 'zdjecie'),
(8, '', '', '', 15, 'pytanie_testowe'),
(9, '1029b_1794245133.jpg', '11 Listopada: Dzień, w którym Polska wrócila na mapę!', 'Upamiętnia odzyskanie przez Polskę niepodległości w 1918 roku, po 123 latach zaborów. Tego dnia – wraz z zakończeniem I wojny światowej – Polska powróciła na mapę świata, a Józef Piłsudski przejął władzę nad odradzającym się państwem. Świętujemy go, wywieszając biało-czerwone flagi i biorąc udział w uroczystościach.', 20, 'zdjecie'),
(10, '', '', '', 15, 'pytanie_testowe'),
(11, 'IMG_7521-1-1024x969.jpeg', 'Warsztaty profilaktyczne dla uczniów', 'W dniach 1 i 8 października 2026 r. uczniowie licznych klas naszej szkoły wzięli udział w warsztatach prowadzonych przez specjalistki z SOPRiIK w Łukowie.', 15, 'zdjecie'),
(12, '', '', '', 15, 'pytanie_testowe'),
(13, 'Zrzut-ekranu-2026-10-10-155333.png', 'Zespół Szkół Nr 1 szkołą partnerską SCWEW w Łukowie!', 'Nasza szkoła nawiązała współpracę ze Specjalistycznym Centrum Wspierającym Edukację Włączającą (SCWEW) w Łukowie. Dzięki temu zyskujemy specjalistyczne wsparcie i nowe możliwości, by jeszcze lepiej odpowiadać na potrzeby uczniów i tworzyć przestrzeń do rozwoju dla każdego z nich.', 20, 'zdjecie'),
(14, '', '', '', 15, 'pytanie_testowe'),
(15, '1029b_1794245413.jpg', '11 Listopada: Dzień, w którym Polska wrócila na mapę!', 'Upamiętnia odzyskanie przez Polskę niepodległości w 1918 roku, po 123 latach zaborów. Tego dnia – wraz z zakończeniem I wojny światowej – Polska powróciła na mapę świata, a Józef Piłsudski przejął władzę nad odradzającym się państwem. Świętujemy go, wywieszając biało-czerwone flagi i biorąc udział w uroczystościach.', 20, 'zdjecie'),
(16, '', '', '', 15, 'pytanie_testowe'),
(17, 'logo_echo-1024x683.jpg', 'Konkurs Literacki „Echo łukowskich lasów - Ksiądz Generał Stanisław Brzóska - niezłomny obrońca wolności.\"', 'Zapraszamy do udziału w konkursie literackim organizowanym przez posła do PE Mariusza Kamińskiego, Starostę Łukowskiego Dariusza Szustka oraz Klub Gazety Polskiej Łuków. Inicjatywa ma na celu promowanie postaw patriotycznych, piękna języka ojczystego oraz odkrywanie młodych talentów.', 20, 'zdjecie'),
(18, '', '', '', 15, 'pytanie_testowe'),
(19, '29.10.2026-BCU-DLA-SZKOL-warsztaty-1.jpg', 'BCU DLA SZKÓŁ – Technologie, praktyka, przemysł', '29 października 2026 r. w łukowskim BCU odbyły się warsztaty dla 34 nauczycieli i doradców zawodowych z 24 szkół podstawowych. Spotkanie poświęcono łączeniu nowoczesnych technologii przemysłowych z edukacją i lepszemu doradztwu zawodowemu dla młodzieży.', 15, 'zdjecie'),
(20, '', '', '', 15, 'pytanie_testowe'),
(21, '1029b_1794245755.jpg', '11 Listopada: Dzień, w którym Polska wrócila na mapę!', 'Upamiętnia odzyskanie przez Polskę niepodległości w 1918 roku, po 123 latach zaborów. Tego dnia – wraz z zakończeniem I wojny światowej – Polska powróciła na mapę świata, a Józef Piłsudski przejął władzę nad odradzającym się państwem. Świętujemy go, wywieszając biało-czerwone flagi i biorąc udział w uroczystościach.', 20, 'zdjecie'),
(22, '', '', '', 15, 'pytanie_testowe'),
(23, '4.-Podziel-sie-wspomnieniem-z-ALEJ.jpg', '100 LAT - 100 HISTORII, PODZIEL SIĘ WSPOMNIENIEM Z ALEJ!', 'W 2027 roku „Aleje” będą obchodzić jubileusz 100-lecia istnienia. Z tej okazji zapraszamy absolwentów, nauczycieli, pracowników oraz ich rodziny do wspólnego tworzenia wyjątkowej kolekcji wspomnień i pamiątek o historii naszej szkoły.', 20, 'zdjecie'),
(24, '', '', '', 15, 'pytanie_testowe'),
(25, 'att.b1O6q2nvwlzVoXoPbHBIz1BrP6JlH-hhefbnGNsAPDk-852x1024.jpg', 'Tydzień Uczniowskiej Supermocy - Nasze drzewo supermocy', 'W naszej szkole zrealizowaliśmy ogólnopolski projekt „Tydzień Uczniowskiej Supermocy”, którego celem jest odkrywanie mocnych stron uczniów, wzmacnianie poczucia własnej wartości oraz budowanie pozytywnego obrazu siebie.', 15, 'zdjecie'),
(26, '', '', '', 15, 'pytanie_testowe'),
(27, '1029b_1794245935.jpg', '11 Listopada: Dzień, w którym Polska wrócila na mapę!', 'Upamiętnia odzyskanie przez Polskę niepodległości w 1918 roku, po 123 latach zaborów. Tego dnia – wraz z zakończeniem I wojny światowej – Polska powróciła na mapę świata, a Józef Piłsudski przejął władzę nad odradzającym się państwem. Świętujemy go, wywieszając biało-czerwone flagi i biorąc udział w uroczystościach.', 20, 'zdjecie'),
(28, '', '', '', 15, 'pytanie_testowe'),
(29, 'IMG20260928120549-1024x578.jpg', 'VII Ogólnopolski Tydzień Szczęścia w Szkole', 'W dniach 28 września – 4 października 2026 r. w naszej szkole odbył się VII Ogólnopolski Tydzień Szczęścia w Szkole pod hasłem „W dialogu z przyszłością”. Każdy dzień przyniósł inne wyzwania, zadania i inspiracje, które promowały dobrostan, dbanie o zdrowie psychiczne oraz refleksję nad przyszłością wśród całej społeczności szkolnej.', 20, 'zdjecie'),
(30, '', '', '', 15, 'pytanie_testowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_testowe`
--

CREATE TABLE `pytania_testowe` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `tresc_pytania` varchar(255) NOT NULL,
  `odp_a` varchar(255) NOT NULL,
  `odp_b` varchar(255) NOT NULL,
  `odp_c` varchar(255) NOT NULL,
  `odp_d` varchar(255) NOT NULL,
  `poprawna_odp` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania_testowe`
--

INSERT INTO `pytania_testowe` (`id`, `news_id`, `tresc_pytania`, `odp_a`, `odp_b`, `odp_c`, `odp_d`, `poprawna_odp`) VALUES
(1, 2, 'Kiedy Polska oficjalnie odzyskała niepodległość po 123 latach zaborów?', '3 maja 1791 r.', '15 sierpnia 1920 r.', '11 listopada 1918 r.', '28 czerwca 1919 r.', 'C'),
(2, 4, 'Przez jakie miasto przepływa Wisła?', 'Wrocław', 'Poznań', 'Warszawa', 'Szczecin', 'C'),
(3, 6, 'Który szczyt jest najwyższy w Polsce?', 'Śnieżka', 'Rysy', 'Babia Góra', 'Kasprowy Wierch', 'B'),
(4, 8, 'Jaka jest stolica Australii?', 'Sydney', 'Melbourne', 'Canberra', 'Perth', 'C'),
(5, 10, 'W którym roku Sejm RP ustanowił 11 listopada oficjalnym, państwowym Świętem Niepodległości?', '1918 r.', '1926 r.', '1937 r. (a przywrócono w 1989 r.)', '1945 r.', 'C'),
(6, 12, 'Która wyspa jest największa na świecie?', 'Madagaskar', 'Grenlandia', 'Borneo', 'Islandia', 'B'),
(7, 14, 'Jak nazywa się linia o szerokości geograficznej 0°?', 'Zwrotnik Raka', 'Południk zerowy', 'Równik', 'Koło podbiegunowe', 'C'),
(8, 16, 'Ile wynosi pierwiastek ze 144?', '10', '11', '12', '14', 'C'),
(9, 18, 'Jakie są rozwiązania równania x^2 - 5x + 6 = 0?', '1 i 6', '2 i 3', '–2 i –3', '0 i 6', 'B'),
(10, 20, 'Ile wynosi 30% z 250?', '65', '70', '75', '80', 'C'),
(11, 22, 'Ile wynosi suma kątów wewnętrznych trójkąta?', '90°', '180°', '270°', '360°', 'B'),
(12, 24, 'Jaki jest kolejny wyraz ciągu: 4, 7, 10, 13, …?', '14', '15', '16', '17', 'C'),
(13, 26, 'Kto napisał „Lalkę”?', 'Henryk Sienkiewicz', 'Bolesław Prus', 'Stefan Żeromski', 'Władysław Reymont', 'B'),
(14, 28, 'Kto jest autorem „Pana Tadeusza”?', 'Juliusz Słowacki', 'Adam Mickiewicz', 'Zygmunt Krasiński', 'Aleksander Fredro', 'B'),
(15, 30, 'Który gatunek reprezentuje „Dziady cz. III”?', 'Powieść', 'Epika', 'Dramat', 'Fraszka', 'C');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pytania_testowe`
--
ALTER TABLE `pytania_testowe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pytania_testowe`
--
ALTER TABLE `pytania_testowe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
